<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="users view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarUsuario', $user->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($user->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $user->id], ['confirm' => __('¿Está seguro de inactivar el usuario # {0}?', $user->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($user->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $user->id], ['confirm' => __('¿Está seguro de activar el usuario # {0}?', $user->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Usuario') ?></h3>
    <div class="users view content">
        <h3><?= h($user->nombre) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($user->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Nombre') ?></th>
                <td><?= h($user->nombre) ?></td>
            </tr>
            <tr>
                <th><?= __('Tipo Documento') ?></th>
                <td><?= h($user->tipo->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('Documento') ?></th>
                <td><?= h($user->documento) ?></td>
            </tr>
            <tr>
                <th><?= __('Celular') ?></th>
                <td><?= h($user->celular) ?></td>
            </tr>
            <tr>
                <th><?= __('Rol') ?></th>
                <td><?= h($user->role->rol,) ?></td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($user->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario') ?></th>
                <td><?= h($user->usuario) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $user->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($user->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($user->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($user->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modificado') ?></th>
                <td><?= h($user->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>

