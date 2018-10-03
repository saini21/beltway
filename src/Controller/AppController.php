<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $responseCode = SUCCESS_CODE;
    public $responseMessage = "";
    public $responseData = [];
    public $currentPage = 0;
    public $authUserId = 0;
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        
        $this->loadComponent('Auth', [
            'userModel' => 'Users',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Articles',
                'action' => 'platform'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'register'
            ],
        ]);
    
        $loggedInUser = $this->Cookie->read('loggedInUser');
    
        if (!empty($loggedInUser) && !$this->Auth->user()) {
            $this->Auth->setUser($loggedInUser);
            $this->redirect($this->Auth->redirectUrl());
        }
        
        if ($this->Auth->user()) {
            $this->set('authUser', $this->Auth->user());
        } else {
            //die('1');
            $this->viewBuilder()->setLayout('home');
        }
    }
    
    public function beforeFilter(Event $event) {
        /*
         * This is used to redirect the user if admin is login and want to access the user site
         */
        $user = $this->Auth->user();
        if (isset($user['role']) && $user['role'] == 'Admin') {
            return $this->redirect(['controller' => 'Admins', 'action' => 'dashboard', 'prefix' => 'admin']);
        }
    }
    
    
    public function responseFormat() {
        $returnArray = [
            "code" => $this->responseCode,
            "message" => $this->responseMessage,
        ];
        if ($this->currentPage > 0) {
            $this->responseData['currentPage'] = $this->currentPage;
        }
        
        if (isset($this->responseData['total'])) {
            $this->responseData['pages'] = ceil($this->responseData['total'] / PAGE_LIMIT);
        }
        
        $returnArray['data'] = !empty($this->responseData) ? $this->responseData : ['message' => 'Data not found'];
        
        return json_encode($returnArray);
    }
    
    public function getErrorMessage($errors, $show = false, $field = []) {
        if (is_array($errors)) {
            foreach ($errors as $key => $error) {
                $field[$key] = "[" . $key . "]";
                $this->getErrorMessage($error, $show, $field);
                break;
            }
        } else {
            $this->responseMessage = ($show) ? implode(" >> ", $field) . " >> " . $errors : $errors;
        }
    }
    
    public function getCurrentPage() {
        $this->currentPage = (!empty($this->request->query['page']) && $this->request->query['page'] > 0) ? $this->request->query['page'] : 1;
        return $this->currentPage;
    }
    
    public function usaStates() {
        return
            [
                'Alabama' => 'Alabama',
                'Alaska' => 'Alaska',
                'Arizona' => 'Arizona',
                'Arkansas' => 'Arkansas',
                'California' => 'California',
                'Colorado' => 'Colorado',
                'Connecticut' => 'Connecticut',
                'Delaware' => 'Delaware',
                'District Of Columbia' => 'District Of Columbia',
                'Florida' => 'Florida',
                'Georgia' => 'Georgia',
                'Hawaii' => 'Hawaii',
                'Idaho' => 'Idaho',
                'Illinois' => 'Illinois',
                'Indiana' => 'Indiana',
                'Iowa' => 'Iowa',
                'Kansas' => 'Kansas',
                'Kentucky' => 'Kentucky',
                'Louisiana' => 'Louisiana',
                'Maine' => 'Maine',
                'Maryland' => 'Maryland',
                'Massachusetts' => 'Massachusetts',
                'Michigan' => 'Michigan',
                'Minnesota' => 'Minnesota',
                'Mississippi' => 'Mississippi',
                'Missouri' => 'Missouri',
                'Montana' => 'Montana',
                'Nebraska' => 'Nebraska',
                'Nevada' => 'Nevada',
                'New Hampshire' => 'New Hampshire',
                'New Jersey' => 'New Jersey',
                'New Mexico' => 'New Mexico',
                'New York' => 'New York',
                'North Carolina' => 'North Carolina',
                'North Dakota' => 'North Dakota',
                'Ohio' => 'Ohio',
                'Oklahoma' => 'Oklahoma',
                'Oregon' => 'Oregon',
                'Pennsylvania' => 'Pennsylvania',
                'Rhode Island' => 'Rhode Island',
                'South Carolina' => 'South Carolina',
                'South Dakota' => 'South Dakota',
                'Tennessee' => 'Tennessee',
                'Texas' => 'Texas',
                'Utah' => 'Utah',
                'Vermont' => 'Vermont',
                'Virginia' => 'Virginia',
                'Washington' => 'Washington',
                'West Virginia' => 'West Virginia',
                'Wisconsin' => 'Wisconsin',
                'Wyoming' => 'Wyoming',
            ];
    }
}
