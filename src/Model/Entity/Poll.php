<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Poll Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $topic
 * @property string $question
 * @property string $answer1
 * @property string $answer2
 * @property string $answer3
 * @property string $answer4
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\PollAnswer[] $poll_answers
 */
class Poll extends Entity
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
        'topic' => true,
        'question' => true,
        'answer1' => true,
        'answer2' => true,
        'answer3' => true,
        'answer4' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'poll_answers' => true
    ];
}
