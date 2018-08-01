<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChatMessageRecipients Model
 *
 * @property \App\Model\Table\ChatMessagesTable|\Cake\ORM\Association\BelongsTo $ChatMessages
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ChatMessageRecipient get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChatMessageRecipient findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChatMessageRecipientsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('chat_message_recipients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ChatMessages', [
            'foreignKey' => 'chat_message_id',
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->boolean('is_read')
            ->requirePresence('is_read', 'create')
            ->notEmpty('is_read');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['chat_message_id'], 'ChatMessages'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
