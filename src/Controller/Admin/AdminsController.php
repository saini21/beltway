<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 *
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminsController extends AppController {
    
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login', 'forgotPassword', 'resetPassword', 'add']);
    }
    
    public function login(){
        $this->viewBuilder()->setLayout('admin_login');
        if ($this->request->is('post')) {
            $admin = $this->Auth->identify();
            if ($admin) {
                $this->Auth->setUser($admin);
                if (isset($this->request->getData()['xx'])) {
                    $this->Cookie->write('beltway_remembertoken', $this->encryptpass($this->request->data['email'])."^".base64_encode($this->request->data['password']), true);
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Email or password is incorrect'));
                $this->redirect('/admin');
            }
        } elseif(empty($this->data)) {
            $rememberToken = $this->Cookie->read('beltway_remembertoken');
            if (!is_null($rememberToken)) {
                $rememberToken = explode("^",$rememberToken);
                $data = $this->Admins->find('all', ['conditions' => ['remember_token'=>$rememberToken[0]]], ['fields'=>['email','password']])->first();
                
                $this->request->data['email'] = $data->email;
                $this->request->data['password'] = base64_decode($rememberToken[1]);
                $admin = $this->Auth->identify();
                if ($admin) {
                    $this->Auth->setUser($admin);
                    $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->redirect('/admin');
                }
            }
        }
    }
    
    public function dashboard() {
        $this->loadModel('Users');
        $this->loadModel('Polls');
        $this->loadModel('Articles');
        $politicianCount = $this->Users->find('all')->where(['role'=>'Politician'])->count();
        $privateCitizenCount = $this->Users->find('all')->where(['role'=>'Private Citizen'])->count();
        $activePollsCount = $this->Polls->find('all')->where(['status'=>true])->count();
        $agendaCount = $this->Articles->find('all')->count();
        $this->set(compact(['politicianCount','privateCitizenCount','activePollsCount', 'agendaCount']));
    }
    
    public function forgotPassword() {
        $this->viewBuilder()->setLayout('admin_login');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->findByEmail($this->request->data['email'])->first();
            if (!empty($admin)) {
                $admin->forgot_password_token = md5(uniqid(rand(), true));
                if ($this->Admins->save($admin)) {
                    $options = [
                        'template' => 'forgot_password',
                        'to' => $this->request->data['email'],
                        'subject' => _('Reset Password'),
                        'from' => ['shooten@gmail.com' => SITE_TITLE],
                        'sender' => ['shooten@gmail.com' => SITE_TITLE],
                        'viewVars' => [
                            'name' => $admin->name,
                            'resetUrl' => $this->request->scheme() . '://' . $this->request->host() . '/admin/admins/reset-password/' . $admin->forgot_password_token,
                        ]
                    ];
                    
                    $this->loadComponent('EmailManager');
                    $this->EmailManager->sendEmail($options);
                    $this->Flash->success(__('A link to reset the password with the instruction has been sent to your inbox'));
                }
            } else {
                $this->Flash->error(__('Email does not exists'));
            }
            return $this->redirect(['Controller' => 'admins', 'action' => 'forgot-password']);
        }
    }
    
    public function resetPassword($forgotPasswordToken) {
        //if ($this->Auth->user()) {
        //   return $this->redirect($this->Auth->redirectUrl());
        // }
        $this->viewBuilder()->setLayout('admin_login');
        $admin = $this->Admins->findByForgotPasswordToken($forgotPasswordToken)->first();
        $isValidPasswordToken = false;
        if (!empty($admin)) {
            $this->set('isValidPasswordToken', $isValidPasswordToken);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData('password') == $this->request->getData('confirm_password')) {
                $admin->password = $this->request->getData('password');
                if ($this->Admins->save($admin)) {
                    $this->Flash->success(__('Password has been reset.'));
                    return $this->redirect(['controller' => 'admins', 'action' => 'login']);
                }else{
                    $this->Flash->error(__('Password has not been set.'));
                }
            } else {
                $this->Flash->error(__('Confirm Password does not match with Password'));
            }
        }
    }
    
    public function logout() {
        $this->Auth->logout();
        $this->request->session()->destroy();
        $this->Cookie->delete('hooty_remembertoken');
        $this->Flash->success(__('You are now logged out'));
        return $this->redirect(['controller' => 'Admins', 'action' => 'login']);
    }
    
    public function profile() {
        
        $admin = $this->Admins->get($this->Auth->user('id'));
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            if(empty($this->request->getData('password'))) {
                unset($this->request->data["password"]);
            }
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            //pr($admin);die;
            // die("done");
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));
                $this->Auth->setUser($admin);
                
                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $this->set(compact('admin'));
    }
    
    public function delete_profile_photo() {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->query('id'))) {
            $adminsTable = TableRegistry::get('Admins');
            $data = $adminsTable->get($this->request->query('id'));
            $file_name = $data['profile_image'];
            $data->profile_image = '';
            if($adminsTable->save($data)) {
                $path = WWW_ROOT.'files/Admins/profile_image/'.$file_name;
                if (file_exists($path))
                {
                    chmod($path,777);
                    unlink($path);
                    $this->Flash->success(__('Profile photo has been deleted successfully.'));
                    $this->response->type('text');
                    $this->response->body(true);
                    return $this->response;
                }
            }
        }
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $admins = $this->paginate($this->Admins);
        
        $this->set(compact('admins'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);
        
        $this->set('admin', $admin);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $admin = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $this->set(compact('admin'));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $this->set(compact('admin'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Admins->get($id);
        if ($this->Admins->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
