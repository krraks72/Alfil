<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ventanilla $ventanilla
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="ventanillas view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarVentanilla', $ventanilla->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($ventanilla->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $ventanilla->id], ['confirm' => __('¿Está seguro de inactivar la ventanilla # {0}?', $ventanilla->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($ventanilla->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $ventanilla->id], ['confirm' => __('¿Está seguro de activar la ventanilla # {0}?', $ventanilla->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Ventanilla') ?></h3>
    <div class="ventanillas view content">
        <h3><?= h($ventanilla->codigo) ?></h3>
        <table>            
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($ventanilla->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Código') ?></th>
                <td><?= h($ventanilla->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('Ventanilla') ?></th>
                <td><?= h($ventanilla->ventanilla) ?></td>
            </tr>
            <tr>
                <th><?= __('Area') ?></th>
                <td><?= h($ventanilla->area->area) ?></td>
            </tr>
            <tr>
                <th><?= __('Sede') ?></th>
                <td><?= h($ventanilla->sede->sede) ?></td>
            </tr>
            <tr>
                <th><?= __('Sala') ?></th>
                <td><?= h($ventanilla->sala->sala) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $ventanilla->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($ventanilla->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($ventanilla->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($ventanilla->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($ventanilla->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
