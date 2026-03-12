<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfile $perfile
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="perfiles view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarPerfile', $perfile->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($perfile->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $perfile->id], ['confirm' => __('¿Está seguro de inactivar el perfil # {0}?', $perfile->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($perfile->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $perfile->id], ['confirm' => __('¿Está seguro de activar el perfil # {0}?', $perfile->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Perfil') ?></h3>
    <div class="perfiles form content">
        <h3><?= h($perfile->perfil) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($perfile->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Perfil') ?></th>
                <td><?= h($perfile->perfil) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $perfile->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($perfile->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($perfile->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($perfile->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($perfile->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
