<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PollAnswers Model
 *
 * @property \App\Model\Table\PollsTable|\Cake\ORM\Association\BelongsTo $Polls
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PollAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\PollAnswer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PollAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PollAnswer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PollAnswer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PollAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PollAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PollAnswer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PollAnswersTable extends Table {
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        
        $this->setTable('poll_answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Polls', [
            'foreignKey' => 'poll_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('answer')
            ->maxLength('answer', 255)
            ->requirePresence('answer', 'create')
            ->notEmpty('answer');
        
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
        $rules->add($rules->existsIn(['poll_id'], 'Polls'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        
        return $rules;
    }
}
