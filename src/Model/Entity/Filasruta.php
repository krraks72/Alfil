<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Filasruta Entity
 *
 * @property int $id
 * @property int $rutaId
 * @property int $filaId
 * @property bool $estado
 * @property string $usuarioCrea
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $usuarioMod
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Fila $fila
 * @property \App\Model\Entity\Ruta $ruta
 */
class Filasruta extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @property \App\Model\Entity\Filas $fila
     * @property \App\Model\Entity\Rutas $ruta
     * 
     * @var array<string, bool>
     */
    protected $_accessible = [
        'rutaId' => true,
        'filaId' => true,
        'estado' => true,
        'usuarioCrea' => true,
        'created' => true,
        'usuarioMod' => true,
        'modified' => true,
        'fila' => true,
        'ruta' => true,
    ];
}
