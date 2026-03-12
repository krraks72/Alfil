<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Opcione Entity
 *
 * @property int $id
 * @property string $opcion
 * @property string $etiqueta
 * @property int $moduloId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Permiso[] $permisos
 * @property \App\Model\Entity\Modulo $modulo
 *
 */
class Opcione extends Entity
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
        'opcion' => true,
        'etiqueta' => true,
        'moduloId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'permisos' => true,
        'modulo' => true,
    ];
}
