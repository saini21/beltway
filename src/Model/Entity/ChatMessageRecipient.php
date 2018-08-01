<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChatMessageRecipient Entity
 *
 * @property int $id
 * @property int $chat_message_id
 * @property int $user_id
 * @property bool $is_read
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ChatMessage $chat_message
 * @property \App\Model\Entity\User $user
 */
class ChatMessageRecipient extends Entity {
    
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
        'chat_message_id' => true,
        'user_id' => true,
        'is_read' => true,
        'created' => true,
        'modified' => true,
        'chat_message' => true,
        'user' => true
    ];
}
