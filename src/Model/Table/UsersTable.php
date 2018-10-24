<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property |\Cake\ORM\Association\HasMany $UserDetails
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table {
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        
        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
    
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'profile_image' => [
                'nameCallback' => function ($data, $settings) {
                    $parts = pathinfo($data['name']);
                    return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $parts['filename']) . '-' . uniqid() . '.' . $parts['extension']);
                },
                'restoreValueOnFailure' => false,
                'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
        
                    // Store the thumbnail in a temporary file
                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
        
                    // Use the Imagine library to DO THE THING
                    $size = new \Imagine\Image\Box(200, 200);
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                    $imagine = new \Imagine\Gd\Imagine();
        
                    // Save that modified file to our temp file
                    $imagine->open($data['tmp_name'])
                        ->thumbnail($size, $mode)
                        ->save($tmp);
        
                    // Now return the original *and* the thumbnail
                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp => 'thumbnail-' . $data['name'],
                    ];
                },
            ]
        ]);
        
        $this->hasMany('UserDetails', [
            'foreignKey' => 'user_id'
        ]);
    }
    
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');
        
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');
        
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');
        
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');
        
        $validator
            ->scalar('non_governmental_email')
            ->maxLength('non_governmental_email', 255)
            ->allowEmpty('non_governmental_email');
        
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        
        $validator
            ->allowEmpty('profile_image');

		$validator
            ->allowEmpty('phone_number');
            		
        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmpty('city');
        
        $validator
            ->scalar('state')
            ->maxLength('state', 100)
           ->allowEmpty('state');
        
        $validator
            ->scalar('role')
            ->maxLength('role', 255)
            ->allowEmpty('role');
        
        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmpty('type');
        
        $validator
            ->boolean('registration_steps_done')
            ->allowEmpty('registration_steps_done');
        
        $validator
            ->scalar('forgot_password_token')
            ->maxLength('forgot_password_token', 255)
            ->allowEmpty('forgot_password_token');
            
        
        $validator
            ->boolean('active')
            ->allowEmpty('active');
    
        $validator
            ->allowEmpty('profile_image')
            ->add('profile_image', [
                'validExtension' => [
                    'rule' => ['extension', ['jpeg', 'png', 'jpg']],
                    'message' => __('Only these files extension are allowed: .png , .jpeg and .jpg')
                ]
            ])
            ->add('profile_image', 'fileBelowMaxSize', [
                'rule' => ['isBelowMaxSize', 1000000 * 5],
                'message' => 'This photo is too large, max limit is 5 mb',
                'provider' => 'upload'
            ])
            ->add('file', 'fileFileUpload', [
                'rule' => 'isFileUpload',
                'message' => 'There was no file found to upload',
                'provider' => 'upload'
            ]);
        
        return $validator;
    }
    
    public function validationEditUser(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');
    
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');
    
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');
    
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');
    
        $validator
            ->scalar('non_governmental_email')
            ->maxLength('non_governmental_email', 255)
            ->allowEmpty('non_governmental_email');
    
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');
    
        $validator->allowEmpty('profile_image');
        
        $validator
            ->allowEmpty('phone_number');
    
        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmpty('city');
    
        $validator
            ->scalar('state')
            ->maxLength('state', 100)
            ->allowEmpty('state');
    
        $validator
            ->scalar('role')
            ->maxLength('role', 255)
            ->allowEmpty('role');
    
        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmpty('type');
    
        $validator
            ->boolean('registration_steps_done')
            ->allowEmpty('registration_steps_done');
    
        $validator
            ->scalar('forgot_password_token')
            ->maxLength('forgot_password_token', 255)
            ->allowEmpty('forgot_password_token');
    
    
        $validator
            ->boolean('active')
            ->allowEmpty('active');
    
        $validator
            ->allowEmpty('profile_image')
            ->add('profile_image', [
                'validExtension' => [
                    'rule' => ['extension', ['jpeg', 'png', 'jpg']],
                    'message' => __('Only these files extension are allowed: .png , .jpeg and .jpg')
                ]
            ])
            ->add('profile_image', 'fileBelowMaxSize', [
                'rule' => ['isBelowMaxSize', 1000000 * 5],
                'message' => 'This photo is too large, max limit is 5 mb',
                'provider' => 'upload'
            ])
            ->add('file', 'fileFileUpload', [
                'rule' => 'isFileUpload',
                'message' => 'There was no file found to upload',
                'provider' => 'upload'
            ]);
    
    
        return $validator;
    }
    
    /*
     * This validation method is used when adding new user
     */
    
    public function validationNewUser(Validator $validator) {
        
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');
    
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');
    
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');
    
        $validator
            ->scalar('non_governmental_email')
            ->maxLength('non_governmental_email', 255)
            ->allowEmpty('non_governmental_email');
    
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');
    
        $validator
            ->allowEmpty('profile_image');
    
        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmpty('city');
    
        $validator
            ->scalar('state')
            ->maxLength('state', 100)
            ->allowEmpty('state');
    
        $validator
            ->scalar('role')
            ->maxLength('role', 255)
            ->allowEmpty('role');
    
        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmpty('type');
    
        $validator
            ->boolean('registration_steps_done')
            ->allowEmpty('registration_steps_done');
    
        $validator
            ->scalar('forgot_password_token')
            ->maxLength('forgot_password_token', 255)
            ->allowEmpty('forgot_password_token');
    
    
        $validator
            ->boolean('active')
            ->allowEmpty('active');
    
        $validator
            ->allowEmpty('profile_image')
            ->add('profile_image', [
                'validExtension' => [
                    'rule' => ['extension', ['jpeg', 'png', 'jpg']],
                    'message' => __('Only these files extension are allowed: .png , .jpeg and .jpg')
                ]
            ])
            ->add('profile_image', 'fileBelowMaxSize', [
                'rule' => ['isBelowMaxSize', 1000000 * 5],
                'message' => 'This photo is too large, max limit is 5 mb',
                'provider' => 'upload'
            ])
            ->add('file', 'fileFileUpload', [
                'rule' => 'isFileUpload',
                'message' => 'There was no file found to upload',
                'provider' => 'upload'
            ]);
    
        return $validator;
    }
    
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['email']));
        
        return $rules;
    }
}
