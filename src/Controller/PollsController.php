<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
    
    public function exitPolling() {
        $showBtn = false;
        $authUser = $this->Auth->user();
        if (($authUser['role'] == "Private Citizen" && $authUser['user_type'] == "Activist") || ($authUser['role'] == "Politician" && $authUser['user_type'] == "Politician")) {
            $showBtn = true;
        }
    
    
        $this->set('showBtn', $showBtn);
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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function getPollsApi($page = 1) {
        $this->autoRender = false;
        $polls = $this->__getPolls($page);
        
        if (empty($polls)) {
            
            $this->responseCode = CODE_BAD_REQUEST;
            $this->responseMessage = __('No record found');
        } else {
            $this->responseCode = SUCCESS_CODE;
            $this->responseData['polls'] = $polls;
        }
        
        echo $this->responseFormat();
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create() {
        $poll = $this->Polls->newEntity();
        if ($this->request->is('post')) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            $poll->user_id = $this->Auth->user('id');
            $poll->status = true;
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));
                
                return $this->redirect(['action' => 'exitPolling']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $this->set(compact('poll'));
    }
    
    
    private function __getPolls($page = 1) {
        $offset = ($page - 1) * PAGE_LIMIT;
        
        $polls = $this->Polls->find('all', ['conditions'=>['Polls.status'=>true]])
            ->contain([
                'Users' => function ($q) {
                    return $q->select(['Users.first_name', 'Users.last_name', 'Users.profile_image']);
                },
                'PollAnswers' => function ($q) {
                    return $q->select(['PollAnswers.poll_id', 'PollAnswers.user_id', 'PollAnswers.answer']);
                }
            ])
            ->order(['Polls.created' => 'DESC'])
            ->offset($offset)
            ->limit(PAGE_LIMIT)
            ->all();
        
        $pollsArray = [];
        if (!empty($polls)) {
            foreach ($polls as $poll) {
                $poll->created = date(SHORT_DATE, strtotime($poll->created));
                $pollsArray[] = $poll;
            }
        }
        
        return $pollsArray;
    }
    
    private function __getPoll($pollId) {
        $poll = $this->Polls->find()
            ->where(['Polls.id' => $pollId])
            ->contain(['Users' => function ($q) {
                return $q->select(['Users.first_name', 'Users.last_name', 'Users.profile_image']);
            }])
            ->order(['Polls.created' => 'DESC'])
            ->first();
        
        if (!empty($poll)) {
            $poll->created = date(SHORT_DATE, strtotime($poll->created));
        }
        
        return $poll;
    }
    
    public function answer(){
        $this->autoRender = false;
        $this->responseCode = CODE_BAD_REQUEST;
        $this->responseMessage = __('Something went wrong, please try again.');
        
        $pollAnswers = TableRegistry::get('PollAnswers');
    
        $pollAnswer = $pollAnswers->newEntity();
    
        $pollAnswer->poll_id = $this->request->data['poll_id'];
        $pollAnswer->user_id = $this->Auth->user('id');
        $pollAnswer->answer = $this->request->data['poll_'.$this->request->data['poll_id']];
        if($pollAnswers->save($pollAnswer)){
            $this->responseCode = SUCCESS_CODE;
            $this->responseMessage = __('Poll has been saved successfully.');
        }
    
        echo $this->responseFormat();
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
