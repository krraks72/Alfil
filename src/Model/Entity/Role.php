<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $rol
 * @property int|null $perfileId
 * @property bool|null $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Perfile $perfile
 */
class Role extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'rol' => true,
        'perfileId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
        'perfile' => true,
    ];
}
