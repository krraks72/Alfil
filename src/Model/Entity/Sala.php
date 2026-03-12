<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sala Entity
 *
 * @property int $id
 * @property string $codigo
 * @property string $sala
 * @property int $sedeId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property \Cake\I18n\FrozenTime|null $created
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $modified
 * 
 * @property \App\Model\Entity\Sede $sede
 */
class Sala extends Entity
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
        'codigo' => true,
        'sala' => true,
        'sedeId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'created' => true,
        'usuarioMod' => true,
        'modified' => true,
        'sede' => true,
    ];
}
