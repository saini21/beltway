<?php

namespace App\Model\Table;


use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserDetails Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserDetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserDetailsTable extends Table {
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        
        $this->setTable('user_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->scalar('are_you_a_registered_voter')
            ->maxLength('are_you_a_registered_voter', 255)
            ->requirePresence('are_you_a_registered_voter', 'create')
            ->notEmpty('are_you_a_registered_voter');
        
        $validator
            ->scalar('did_you_vote_in_last_elections')
            ->maxLength('did_you_vote_in_last_elections', 255)
            ->requirePresence('did_you_vote_in_last_elections', 'create')
            ->notEmpty('did_you_vote_in_last_elections');
        
        $validator
            ->scalar('do_you_think_the_media_is_biased')
            ->requirePresence('do_you_think_the_media_is_biased', 'create')
            ->notEmpty('do_you_think_the_media_is_biased');
        
        $validator
            ->scalar('are_politicians_listening_to_the_american_public')
            ->requirePresence('are_politicians_listening_to_the_american_public', 'create')
            ->notEmpty('are_politicians_listening_to_the_american_public');
        
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
