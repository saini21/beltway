<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserDetail Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $are_you_a_registered_voter
 * @property string $did_you_vote_in_last_elections
 * @property bool $do_you_think_the_media_is_biased
 * @property bool $are_politicians_listening_to_the_american_public
 * @property string $how_active_are_you_in_politics
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class UserDetail extends Entity {
    
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
        'are_you_a_registered_voter' => true,
        'did_you_vote_in_last_elections' => true,
        'do_you_think_the_media_is_biased' => true,
        'are_politicians_listening_to_the_american_public' => true,
        'watch_the_news' => true,
        'attend_rallies' => true,
        'write_to_local_leaders' => true,
        'active_on_social_media' => true,
        'all_the_above' => true,
        'none_of_the_above' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
