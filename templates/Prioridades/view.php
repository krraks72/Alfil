<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prioridade $prioridade
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="prioridades view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarPrioridade', $prioridade->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($prioridade->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $prioridade->id], ['confirm' => __('¿Está seguro de inactivar la prioridad # {0}?', $prioridade->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($prioridade->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $prioridade->id], ['confirm' => __('¿Está seguro de activar la prioridad # {0}?', $prioridade->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Pioridad') ?></h3>
    <div class="prioridades view content">
        <h3><?= h($prioridade->prioridad) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($prioridade->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Prioridad') ?></th>
                <td><?= h($prioridade->prioridad) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $prioridade->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($prioridade->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($prioridade->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($prioridade->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($prioridade->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>