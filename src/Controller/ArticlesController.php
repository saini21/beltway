<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController {
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function platform() {
        $showBtn = false;
        $authUser = $this->Auth->user();
        if (($authUser['role'] == "Private Citizen" && $authUser['user_type'] == "Activist") || ($authUser['role'] == "Politician" && $authUser['user_type'] == "Politician")) {
            $showBtn = true;
        }
        
        
        $this->set('showBtn', $showBtn);
        
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function getArticlesApi($page = 1) {
        $this->autoRender = false;
        $articles = $this->__getArticles($page);
        
        if (empty($articles)) {
            
            $this->responseCode = CODE_BAD_REQUEST;
            $this->responseMessage = __('No record found');
        } else {
            $this->responseCode = SUCCESS_CODE;
            $this->responseData['articles'] = $articles;
        }
        
        echo $this->responseFormat();
        exit;
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function getArticleApi($id = null) {
        $this->autoRender = false;
        $article = $this->__getArticle($id);
        
        if (empty($article)) {
            $this->responseCode = CODE_BAD_REQUEST;
            $this->responseMessage = __('No record found');
        } else {
            $this->responseCode = SUCCESS_CODE;
            $this->responseData['article'] = $article;
        }
        
        echo $this->responseFormat();
    }
    
    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => ['Users', 'ArticleComments', 'ArticleLikes']
        ]);
        
        $this->set('article', $article);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addApi() {
        $this->autoRender = false;
        $this->responseCode = CODE_BAD_REQUEST;
        if ($this->request->is('post')) {
            if ($this->request->data['id'] == "0") {
                $article = $this->Articles->newEntity();
            } else {
                
                $article = $this->Articles->find('all', ['conditions' => ['id' => $this->request->data['id'], 'user_id' => $this->Auth->user('id')]])->first();
            }
            
            $article->user_id = $this->Auth->user('id');
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            
            if ($this->Articles->save($article)) {
                $this->responseMessage = __('Your article has been saved.');
                $this->responseCode = SUCCESS_CODE;
                $this->responseData['article'] = $this->__getArticle($article->id);
            } else {
                $this->getErrorMessage($article->errors());
            }
        }
        echo $this->responseFormat();
    }
    
    private function __getArticles($page = 1) {
        $offset = ($page-1) * PAGE_LIMIT;
        
        $articles = $this->Articles->find()
            ->contain(['Users' => function ($q) {
                return $q->select(['Users.first_name', 'Users.last_name', 'Users.profile_image']);
            },
                'ArticleLikes' => function ($q) {
                    return $q->where(['ArticleLikes.user_id' => $this->Auth->user('id')]);
                }])
            ->order(['Articles.created' => 'DESC'])
            ->offset($offset)
            ->limit(PAGE_LIMIT)
            ->all();
        
        $articlesArray = [];
        if (!empty($articles)) {
            foreach ($articles as $article) {
                $article->created = date(SHORT_DATE, strtotime($article->created));
                $article->content = nl2br($article->content);
                $articlesArray[] = $article;
            }
        }
        
        return $articlesArray;
    }
    
    private function __getArticle($articleId) {
        $article = $this->Articles->find()
            ->where(['Articles.id' => $articleId])
            ->contain(['Users' => function ($q) {
                return $q->select(['Users.first_name', 'Users.last_name', 'Users.profile_image']);
            },
                'ArticleLikes' => function ($q) {
                    return $q->where(['ArticleLikes.user_id' => $this->Auth->user('id')]);
                }])
            ->order(['Articles.created' => 'DESC'])
            ->first();
        
        if (!empty($article)) {
            $article->created = date(SHORT_DATE, strtotime($article->created));
        }
        
        return $article;
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
    
    
    public function likeUnlike() {
        $this->autoRender = false;
        $this->responseCode = CODE_BAD_REQUEST;
        if ($this->request->is('post')) {
            $this->loadModel('ArticleLikes');
            
            $articleLike = $this->ArticleLikes->find()->where([
                'user_id' => $this->Auth->user('id'),
                'article_id' => $this->request->getData('article_id'),
            ])->first();
            
            if ($articleLike) {
                if ($this->ArticleLikes->delete($articleLike)) {
                    $this->responseData['articleLike'] = $articleLike;
                    $this->responseCode = SUCCESS_CODE;
                } else {
                    $this->responseCode = CODE_BAD_REQUEST;
                }
            } else {
                
                $articleLike = $this->ArticleLikes->newEntity();
                $articleLike->user_id = $this->Auth->user('id');
                $articleLike = $this->ArticleLikes->patchEntity($articleLike, $this->request->getData());
                if ($this->ArticleLikes->save($articleLike)) {
                    $this->responseData['articleLike'] = $articleLike;
                    $this->responseCode = SUCCESS_CODE;
                } else {
                    $this->getErrorMessage($articleLike->errors());
                    $this->responseCode = CODE_BAD_REQUEST;
                }
            }
            
            $article = $this->__getLikeCount($this->request->getData('article_id'));
            
            $this->responseData['likes_count'] = $article->like_count;
            
        }
        echo $this->responseFormat();
    }
    
    private function __getLikeCount($articlesId) {
        return $this->Articles->find()->select(['Articles.like_count'])->where(['Articles.id' => $articlesId])->first();
    }
    
    
}
