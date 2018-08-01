<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Polls Controller
 *
 * @property \App\Model\Table\PollsTable $Polls
 *
 * @method \App\Model\Entity\Poll[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PollsController extends AppController {
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $polls = $this->paginate($this->Polls);
        
        $this->set(compact('polls'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $poll = $this->Polls->get($id, [
            'contain' => ['Users', 'PollAnswers']
        ]);
        
        $this->set('poll', $poll);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $poll = $this->Polls->newEntity();
        if ($this->request->is('post')) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $users = $this->Polls->Users->find('list', ['limit' => 200]);
        $this->set(compact('poll', 'users'));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $poll = $this->Polls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $users = $this->Polls->Users->find('list', ['limit' => 200]);
        $this->set(compact('poll', 'users'));
    }
    
    public function changeStatus($id = null) {
        $this->autoRender = false;
        $poll = $this->Polls->get($id);
        $poll->status = !$poll->status;
        $poll = $this->Polls->patchEntity($poll, $this->request->getData());
        $this->Polls->save($poll);
        $response = ['status' => (($poll->status) ? "Enabled" : "Disabled")];
        
        echo json_encode($response);
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $poll = $this->Polls->get($id);
        if ($this->Polls->delete($poll)) {
            $this->Flash->success(__('The poll has been deleted.'));
        } else {
            $this->Flash->error(__('The poll could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
