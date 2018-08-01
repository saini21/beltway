<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * ArticleLikes Controller
 *
 * @property \App\Model\Table\ArticleLikesTable $ArticleLikes
 *
 * @method \App\Model\Entity\ArticleLike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticleLikesController extends AppController {
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Articles', 'Users']
        ];
        $articleLikes = $this->paginate($this->ArticleLikes);
        
        $this->set(compact('articleLikes'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $articleLike = $this->ArticleLikes->get($id, [
            'contain' => ['Articles', 'Users']
        ]);
        
        $this->set('articleLike', $articleLike);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $articleLike = $this->ArticleLikes->newEntity();
        if ($this->request->is('post')) {
            $articleLike = $this->ArticleLikes->patchEntity($articleLike, $this->request->getData());
            if ($this->ArticleLikes->save($articleLike)) {
                $this->Flash->success(__('The article like has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article like could not be saved. Please, try again.'));
        }
        $articles = $this->ArticleLikes->Articles->find('list', ['limit' => 200]);
        $users = $this->ArticleLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('articleLike', 'articles', 'users'));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $articleLike = $this->ArticleLikes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleLike = $this->ArticleLikes->patchEntity($articleLike, $this->request->getData());
            if ($this->ArticleLikes->save($articleLike)) {
                $this->Flash->success(__('The article like has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article like could not be saved. Please, try again.'));
        }
        $articles = $this->ArticleLikes->Articles->find('list', ['limit' => 200]);
        $users = $this->ArticleLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('articleLike', 'articles', 'users'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $articleLike = $this->ArticleLikes->get($id);
        if ($this->ArticleLikes->delete($articleLike)) {
            $this->Flash->success(__('The article like has been deleted.'));
        } else {
            $this->Flash->error(__('The article like could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
