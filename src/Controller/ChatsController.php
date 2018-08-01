<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Utility\PHPSocketIO\SocketIO;
use \Workerman\Worker;

/**
 * Chats Controller
 *
 * @property \App\Model\Table\ChatsTable $Chats
 *
 * @method \App\Model\Entity\Chat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChatsController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['newMessage']);
    }
    
    public function townHall($token = "9fdbf231fd4160a129e590b8b71da453") {
        
        $chats = $this->Chats->find('all')
            ->leftJoin(['ChatMembers' => 'chat_members'], 'ChatMembers.chat_id = Chats.id')
            ->where(['ChatMembers.user_id' => $this->Auth->user('id')])->all();
        
        $currentChat = $this->Chats->find('all')
            ->select(['Chats.id', 'Chats.name', 'Chats.token', 'Chats.user_id'])
            ->contain(['ChatMembers' => function ($q) {
                    return $q->select(['ChatMembers.chat_id', 'ChatMembers.user_id'])
                        ->contain(['Users' => function ($q) {
                            return $q->select(['Users.id', 'Users.first_name', 'Users.last_name', 'Users.profile_image']);
                        }]);
                }]
            )
            ->where(['Chats.token' => $token])->hydrate(false)->first();
        
        if (!empty($currentChat)) {
            $currentChat = $this->formatChat($currentChat);
        }
        
        
        $this->set(compact('chats', 'token', 'currentChat'));
    }
    
    public function createGroup() {
        if ($this->request->is('post')) {
            $token = $this->token();
            $chat = $this->Chats->newEntity();
            $chat->token = $token;
            $chat->name = $this->request->data['name'];
            $chat->user_id = $this->Auth->user('id');
            
            if ($this->Chats->save($chat)) {
                foreach ($this->request->data['user_ids'] as $id) {
                    $data[] = [
                        'user_id' => $id,
                        'chat_id' => $chat->id
                    ];
                }
                $this->loadModel('ChatMembers');
                $entities = $this->ChatMembers->newEntities($data);
                $this->ChatMembers->saveMany($entities);
                $this->Flash->success(__('The group has been created successfully.'));
                $this->redirect(['controller' => 'Chats', 'action' => 'townHall', $token]);
            }
        }
    }
    
    public function editGroup($token = null) {
        
        if ($this->request->is('post')) {
            $chat = $this->Chats->find('all')->where(['Chats.token' => $token])->first();
            $chat->name = $this->request->data['name'];
            
            if ($this->Chats->save($chat)) {
                $this->loadModel('ChatMembers');
                foreach ($this->request->data['user_ids'] as $id) {
                    $condition = [
                        'user_id' => $id,
                        'chat_id' => $chat->id
                    ];
                    
                    $chatMember = $this->ChatMembers->find('all')->where($condition)->first();
                    
                    if (empty($chatMember)) {
                        $chatMember = $this->ChatMembers->newEntity();
                        $chatMember->chat_id = $chat->id;
                        $chatMember->user_id = $id;
                        $this->ChatMembers->save($chatMember);
                    }
                }
                
                $this->Flash->success(__('The group has been updated successfully.'));
                $this->redirect(['controller' => 'Chats', 'action' => 'townHall', $token]);
            }
        }
        
        $chat = $this->Chats->find('all')
            ->select(['Chats.id', 'Chats.name', 'Chats.token', 'Chats.user_id'])
            ->contain(['ChatMembers' => function ($q) {
                    return $q->select(['ChatMembers.chat_id', 'ChatMembers.user_id'])
                        ->contain(['Users' => function ($q) {
                            return $q->select(['Users.id', 'Users.first_name', 'Users.last_name', 'Users.profile_image']);
                        }]);
                }]
            )
            ->where(['Chats.token' => $token])->hydrate(false)->first();
        
        $chat = $this->formatChat($chat);
        $this->set(compact('chat', 'token'));
        
        
    }
    
    private function formatChat($chat) {
        $c = [
            'name' => $chat['name'],
            'token' => $chat['token'],
            'chat_members' => []
        ];
        
        $members = [];
        
        foreach ($chat['chat_members'] as $m) {
            $name = $m['user']['first_name'] . " " . $m['user']['last_name'];
            if (!empty($m['user']['profile_image']) && $m['user']['profile_image'] != "default-user.png") {
                $profileImage = PROFILE_IMAGE_PATH . 'thumbnail-' . $m['user']['profile_image'];
            } else {
                $profileImage = SITE_URL . "/img/default-user.png";
            }
            
            $members[$m['user']['id']] = [
                'name' => $name,
                'profile_image' => $profileImage
            ];
        }
        
        $c['chat_members'] = $members;
        return $c;
    }
    
    
    private function token() {
        return md5(uniqid(rand(), true));
    }
    
    
    public function suggestMembers() {
        $this->autoRender = false;
        $this->loadModel('Users');
        $users = $this->Users->find('all')->where(['Users.id NOT IN' => $this->request->data['user_ids']])->all();
        $members = [];
        foreach ($users as $user) {
            $members[] = $this->memberSuggestionFormat($user);
        }
        
        echo json_encode(['suggestions' => $members]);
        exit;
    }
    
    private function memberSuggestionFormat($user) {
        $name = $user->first_name . " " . $user->last_name;
        if (!empty($user->profile_image) && $user->profile_image != "default-user.png") {
            $profileImage = PROFILE_IMAGE_PATH . 'thumbnail-' . $user->profile_image;
        } else {
            $profileImage = SITE_URL . "/img/default-user.png";
        }
        
        $member = [
            'value' => '<div class="user-suggestion"><img src="' . $profileImage . '" width="40"><label>&nbsp;&nbsp;&nbsp;' . $name . '</label></div>',
            'data' => [
                'id' => $user->id,
                'name' => $name,
                'profile_image' => $profileImage
            ]
        
        ];
        
        return $member;
    }
    
    
    public function newMessage() {
        $this->responseCode = CODE_BAD_REQUEST;
        
        $this->autoRender = false;
        $this->loadModel('ChatMessages');
        $this->loadModel('ChatMessageRecipients');
        if ($this->request->is('post')) {
            
            $chat = $this->Chats->find('all')
                ->contain(['ChatMembers' => function ($q) {
                    return $q->select(['ChatMembers.chat_id', 'ChatMembers.user_id']);
                }])
                ->where(['Chats.token' => $this->request->data['room']])
                ->first();
            
            $message = $this->ChatMessages->newEntity();
            $message->user_id = $this->request->data['main_id'];
            $message->chat_id = $chat->id;
            $message->message = $this->request->data['message'];
            if ($this->ChatMessages->save($message)) {
                $this->responseCode = SUCCESS_CODE;
                $this->responseData['message'] = [
                    'user_id' => $message->user_id,
                    'message' => $message->message,
                ];
                
                $recipients = [];
                
                foreach ($chat->chat_members as $m) {
                    $recipients[] = [
                        'chat_message_id' => $message->id,
                        'user_id' => $m->user_id,
                        'is_read' => $m->user_id != $this->request->data['main_id']
                    ];
                }
                $recipients = $this->ChatMessageRecipients->newEntities($recipients);
                $this->ChatMessageRecipients->saveMany($recipients);
            } else {
                $this->getErrorMessage($message->errors());
            }
        }
        
        echo $this->responseFormat();
        exit;
        
    }
    
    public function messages($token = null) {
        
        $page = $this->request->query('page');
        $offset = ($page - 1) * PAGE_LIMIT;
        $this->responseCode = CODE_BAD_REQUEST;
        $this->autoRender = false;
        $this->loadModel('ChatMessages');
        $messages = $this->ChatMessages->find('all')
            ->select(['ChatMessages.user_id', 'ChatMessages.message'])
            ->leftJoin(['Chats' => 'chats'], 'Chats.id = ChatMessages.chat_id')
            ->where(['Chats.token' => $token])
            ->offset($offset)
            ->limit(PAGE_LIMIT)//
            ->order(['ChatMessages.created' => 'DESC'])
            ->all();
        $this->responseCode = SUCCESS_CODE;
        $this->responseData['messages'] = $messages;
        
        echo $this->responseFormat();
        exit;
        
    }
    
    public function exitGroup($token = null) {
        $chat = $this->Chats->find('all')->where(['Chats.token' => $token])->first();
        $this->loadModel('ChatMembers');
        $chatMember = $this->ChatMembers->find('all')
            ->where(['ChatMembers.user_id' => $this->Auth->user('id'), 'ChatMembers.chat_id' => $chat->id])
            ->first();
        if($this->ChatMembers->delete($chatMember)){
            $this->Flash->success(__('You  has been successfully exit from Group.'));
            $this->redirect(['controller' => 'Chats', 'action' => 'townHall', '9fdbf231fd4160a129e590b8b71da453']);
        }
    }
    
}
