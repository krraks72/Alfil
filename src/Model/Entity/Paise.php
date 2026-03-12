<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Paise Entity
 *
 * @property int $id
 * @property string $pais
 * @property string $name
 * @property string $iso2
 * @property string $iso3
 * @property string|null $codePhone
 * @property bool $estado
 * @property string $usuarioCrea
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Departamento[] $departamentos
 */
class Paise extends Entity
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
        'pais' => true,
        'name' => true,
        'iso2' => true,
        'iso3' => true,
        'codePhone' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'usuarioMod' => true,
        'created' => true,
        'modified' => true,
        'departamentos' => true,
    ];
}
