<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArticleComment Entity
 *
 * @property int $id
 * @property string $comment
 * @property int $article_id
 * @property int $user_id
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\User $user
 */
class ArticleComment extends Entity
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
        'comment' => true,
        'article_id' => true,
        'user_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'article' => true,
        'user' => true
    ];
}
