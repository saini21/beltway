<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity
 *
 * @property int $id
 * @property string $role
 * @property string $user_type
 * @property int $user_id
 * @property string $price
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Subscription extends Entity
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
        'role' => true,
        'user_type' => true,
        'user_id' => true,
        'price' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
