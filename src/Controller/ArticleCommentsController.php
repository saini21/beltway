<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * ArticleComments Controller
 *
 * @property \App\Model\Table\ArticleCommentsTable $ArticleComments
 *
 * @method \App\Model\Entity\ArticleComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticleCommentsController extends AppController {
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Articles', 'Users']
        ];
        $articleComments = $this->paginate($this->ArticleComments);
        
        $this->set(compact('articleComments'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Article Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $articleComment = $this->ArticleComments->get($id, [
            'contain' => ['Articles', 'Users']
        ]);
        
        $this->set('articleComment', $articleComment);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function saveApi() {
        $this->autoRender = false;
        $this->responseCode = CODE_BAD_REQUEST;
        
        if ($this->request->is('post')) {
            if($this->request->data['id'] == 0){
                $articleComment = $this->ArticleComments->newEntity();
            } else {
                $articleComment = $this->ArticleComments->find('all', ['conditions'=>['id'=>$this->request->data['id'], 'user_id'=>$this->Auth->user('id')]])->first();
            }
            
            $articleComment = $this->ArticleComments->patchEntity($articleComment, $this->request->getData());
            $articleComment->user_id = $this->Auth->user('id');
            if ($this->ArticleComments->save($articleComment)) {
                $this->responseMessage = __('Your password has been updated.');
                $this->responseCode = SUCCESS_CODE;
                $this->responseData['articleComment'] = $this->__getArticleComment($articleComment->article_id, $articleComment->id);
            } else {
                $this->getErrorMessage($articleComment->errors());
                
            }
        } else {
            $this->Flash->error(__('The article comment could not be saved. Please, try again.'));
        }
        echo $this->responseFormat();
    }
    
    private function __getArticleComment($articleId, $commentId) {
        $articleComment = $this->ArticleComments->find()
            ->where(['ArticleComments.article_id' => $articleId, 'ArticleComments.id' => $commentId,])
            ->contain(['Users' => function ($q) {
                return $q->select(['Users.first_name', 'Users.last_name']);
            }])
            ->order(['ArticleComments.created' => 'DESC'])
            ->first();
        
        
        return $articleComment;
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function getCommentsApi($articleId) {
        $this->autoRender = false;
        $articleComments = $this->__getArticleComments($articleId);
        
        if(empty($articleComments)){
            $this->responseCode = CODE_BAD_REQUEST;
            $this->responseMessage = __('No record found');
        } else {
            $this->responseCode = SUCCESS_CODE;
            $this->responseData['articleComments'] = $articleComments;
        }
        
        echo $this->responseFormat();
    }
    
    private function __getArticleComments($articleId) {
        $articleComments = $this->ArticleComments->find()
            ->where(['ArticleComments.article_id' => $articleId])
            ->contain(['Users' => function ($q) {
                return $q->select(['Users.first_name', 'Users.last_name']);
            }])
            ->order(['ArticleComments.created' => 'ASC'])
            ->all();
        
        return $articleComments;
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Article Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $articleComment = $this->ArticleComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleComment = $this->ArticleComments->patchEntity($articleComment, $this->request->getData());
            if ($this->ArticleComments->save($articleComment)) {
                $this->Flash->success(__('The article comment has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article comment could not be saved. Please, try again.'));
        }
        $articles = $this->ArticleComments->Articles->find('list', ['limit' => 200]);
        $users = $this->ArticleComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('articleComment', 'articles', 'users'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Article Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $articleComment = $this->ArticleComments->get($id);
        if ($this->ArticleComments->delete($articleComment)) {
            $this->Flash->success(__('The article comment has been deleted.'));
        } else {
            $this->Flash->error(__('The article comment could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
