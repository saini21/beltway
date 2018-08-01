<?php

namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller {
    
    public function initialize() {
        
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        
        $this->loadComponent('Auth', [
            'storage' => 'Session',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Admins',
                    'fields' => ['username' => 'email', 'password' => 'password']
                ],
            ],
            'loginAction' => ['controller' => 'Admins', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Admins', 'action' => 'dashboard'],
            'unauthorizedRedirect' => false,
        ]);
        //pr($this->Auth->redirectUrl());die;
        $this->viewBuilder()->setLayout('admin');
    }
    
    public function beforeFilter(Event $event) {
        $user = $this->Auth->user();
        if($user){
            if ($this->request->prefix == 'admin'){
                if(!isset($user['role'])){
                    return $this->redirect(SITE_URL);
                }
            }
        }
    }
    
    
    function encryptpass($password, $method = 'md5', $crop = true, $start = 4, $end = 10) {
        if ($crop) {
            $password = $method(substr($method($password), $start, $end));
        } else {
            $password = $method($password);
        }
        return $password;
    }
    
}
