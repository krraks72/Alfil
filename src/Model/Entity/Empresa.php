<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empresa Entity
 *
 * @property int $id
 * @property string $razonSocial
 * @property string $nit
 * @property int $digito
 * @property string $representante
 * @property string|null $direccion
 * @property string|null $telefono
 * @property int $municipioId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Municipio $municipio
 */
class Empresa extends Entity
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
        'razonSocial' => true,
        'nit' => true,
        'digito' => true,
        'representante' => true,
        'direccion' => true,
        'telefono' => true,
        'municipioId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'municipio' => true,
    ];
}
