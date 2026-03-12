<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Municipio Entity
 *
 * @property int $id
 * @property string $codigo
 * @property string $municipio
 * @property int $departamentoId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Empresa[] $empresas
 * @property \App\Model\Entity\Departamento $departamento
 */
class Municipio extends Entity
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
        'municipio' => true,
        'departamentoId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'empresas' => true,
        'departamento' => true,
    ];
}
