<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fila Entity
 *
 * @property int $id
 * @property string $codigo
 * @property string $Fila
 * @property bool $prioritaria
 * @property int|null $prioridadeId
 * @property bool $validaGenero
 * @property bool $infancia
 * @property bool $discapacidad
 * @property int|null $generoId
 * @property bool $edad
 * @property int|null $edadInicial
 * @property int|null $edadFinal
 * @property bool $estado
 * @property string $usuarioCrea
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Prioridade $prioridade
 * @property \App\Model\Entity\Genero $genero
 */
class Fila extends Entity
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
        'fila' => true,
        'prioritaria' => true,
        'prioridadeId' => true,
        'validaGenero' => true,
        'infancia' => true,
        'discapacidad' => true,
        'generoId' => true,
        'edad' => true,
        'edadInicial' => true,
        'edadFinal' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'created' => true,
        'usuarioMod' => true,
        'modified' => true,
        'prioridade' => true,
        'genero' => true,
    ];
}
