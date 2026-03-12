<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Permiso Entity
 *
 * @property int $id
 * @property int $perfileId
 * @property int $opcioneId
 * @property bool $leer
 * @property bool $editar
 * @property bool $crear
 * @property bool $eliminar
 * @property bool $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Opcione $opcione
 * @property \App\Model\Entity\Perfile $perfile
 */
class Permiso extends Entity
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
        'perfileId' => true,
        'opcioneId' => true,
        'leer' => true,
        'editar' => true,
        'crear' => true,
        'eliminar' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'opcione' => true,
        'perfile' => true,
    ];
}
