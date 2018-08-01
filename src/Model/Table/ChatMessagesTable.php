<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChatMessages Model
 *
 * @property \App\Model\Table\ChatsTable|\Cake\ORM\Association\BelongsTo $Chats
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ChatMessageRecipientsTable|\Cake\ORM\Association\HasMany $ChatMessageRecipients
 *
 * @method \App\Model\Entity\ChatMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChatMessage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChatMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChatMessage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChatMessage|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChatMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChatMessage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChatMessage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChatMessagesTable extends Table
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

        $this->setTable('chat_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Chats', [
            'foreignKey' => 'chat_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ChatMessageRecipients', [
            'foreignKey' => 'chat_message_id'
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
            ->scalar('message')
            ->maxLength('message', 255)
            ->requirePresence('message', 'create')
            ->notEmpty('message');

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
        $rules->add($rules->existsIn(['chat_id'], 'Chats'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
