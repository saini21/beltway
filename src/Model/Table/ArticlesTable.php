<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ArticleCommentsTable|\Cake\ORM\Association\HasMany $ArticleComments
 * @property \App\Model\Table\ArticleLikesTable|\Cake\ORM\Association\HasMany $ArticleLikes
 *
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table {
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        
        $this->setTable('articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
    
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'article_image' => [
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
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ArticleComments', [
            'foreignKey' => 'article_id'
        ]);
        $this->hasMany('ArticleLikes', [
            'foreignKey' => 'article_id'
        ]);
    }
    
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');
        
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');
        
        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmpty('content');
    
        $validator
            ->allowEmpty('article_image');
    
        $validator
            ->scalar('link')
            ->allowEmpty('link');
    
        $validator
            ->scalar('link_host')
            ->allowEmpty('link_host');
    
        $validator
            ->scalar('link_title')
            ->allowEmpty('link_title');
        $validator
            ->scalar('link_image')
            ->allowEmpty('link_image');
        $validator
            ->scalar('link_description')
            ->allowEmpty('link_description');
        
        $validator
            ->integer('like_count')
            ->allowEmpty('like_count');
        
        $validator
            ->boolean('status')
            ->allowEmpty('status');
        
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
    
}
