<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property int $age
 * @property string $email
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $nationality_id
 *
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Comment[] $comments
 */
class User extends Entity
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
        'name' => true,
        'lastname' => true,
        'age' => true,
        'email' => true,
        'username' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'nationality_id' => true,
        'articles' => true,
        'comments' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
