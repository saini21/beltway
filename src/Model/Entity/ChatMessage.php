<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChatMessage Entity
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string $message
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Chat $chat
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ChatMessageRecipient[] $chat_message_recipients
 */
class ChatMessage extends Entity
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
        'chat_id' => true,
        'user_id' => true,
        'message' => true,
        'created' => true,
        'chat' => true,
        'user' => true,
        'chat_message_recipients' => true
    ];
}
