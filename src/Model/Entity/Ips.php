<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ips Entity
 *
 * @property int $id
 * @property string $codigoReps
 * @property string $sigla
 * @property string $nit
 * @property int $digito
 * @property string $ips
 * @property string $direccion
 * @property int $municipioId
 * @property int $empresaId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Municipio $municipio
 * @property \App\Model\Entity\Empresa $empresa
 */
class Ips extends Entity
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
        'codigoReps' => true,
        'sigla' => true,
        'nit' => true,
        'digito' => true,
        'ips' => true,
        'direccion' => true,
        'municipioId' => true,
        'empresaId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'municipio' => true,
        'empresa' => true,
    ];
}
