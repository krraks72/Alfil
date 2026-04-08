<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sede $sede
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="sedes view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarSede', $sede->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($sede->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $sede->id], ['confirm' => __('¿Está seguro de inactivar la sede # {0}?', $sede->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($sede->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $sede->id], ['confirm' => __('¿Está seguro de activar la sede # {0}?', $sede->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Sede') ?></h3>
    <div class="sedes view content">
        <h3><?= h($sede->codigoReps) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($sede->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Código REPS') ?></th>
                <td><?= h($sede->codigoReps) ?></td>
            </tr>
            <tr>
                <th><?= __('Habilitación') ?></th>
                <td><?= h($sede->habilitacion) ?></td>
            </tr>
            <tr>
                <th><?= __('Sede') ?></th>
                <td><?= h($sede->sede) ?></td>
            </tr>
            <tr>
                <th><?= __('Dirección') ?></th>
                <td><?= h($sede->direccion) ?></td>
            </tr>
            <tr>
                <th><?= __('Teléfono') ?></th>
                <td><?= h($sede->telefono) ?></td>
            </tr>
            <tr>
                <th><?= __('Municipio') ?></th>
                <td><?= h($sede->municipio->municipio) ?></td>
            </tr>
            <tr>
                <th><?= __('IPS') ?></th>
                <td><?= h($sede->ips->ips) ?></td> 
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $sede->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($sede->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($sede->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($sede->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($sede->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
