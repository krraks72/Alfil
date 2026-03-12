<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Filasventanilla Entity
 *
 * @property int $id
 * @property int $filaId
 * @property int $ventanillaId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Fila $fila
 * @property \App\Model\Entity\Ventanilla $ventanilla
 */
class Filasventanilla extends Entity
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
        'filaId' => true,
        'ventanillaId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'created' => true,
        'usuarioMod' => true,
        'modified' => true,
        'fila' => true,
        'ventanilla' => true,
    ];
}
