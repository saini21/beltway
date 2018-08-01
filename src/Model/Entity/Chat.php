<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chat Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $token
 * @property int $no_of_members
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ChatMember[] $chat_members
 * @property \App\Model\Entity\ChatMessage[] $chat_messages
 */
class Chat extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'name' => true,
        'token' => true,
        'no_of_members' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'chat_members' => true,
        'chat_messages' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
