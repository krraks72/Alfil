<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Permiso $permiso
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="permisos view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarPermiso', $permiso->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($permiso->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $permiso->id], ['confirm' => __('¿Está seguro de inactivar el permiso # {0}?', $permiso->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($permiso->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $permiso->id], ['confirm' => __('¿Está seguro de activar el permiso # {0}?', $permiso->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Permiso') ?></h3>
    <div class="permisos view content">
        <h3><?= 'Rol : ' . h($permiso->perfile->perfil) . ' - ' . 'Opción : ' . h($permiso->opcione->opcion) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($permiso->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Perfil') ?></th>
                <td><?= h($permiso->perfile->perfil) ?></td>
            </tr>
            <tr>
                <th><?= __('Opcion') ?></th>
                <td><?= h($permiso->opcione->opcion) ?></td>
            </tr>
            <tr>
                <th><?= __('Leer') ?></th>
                <td><?= $permiso->leer ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Editar') ?></th>
                <td><?= $permiso->editar ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Crear') ?></th>
                <td><?= $permiso->crear ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Eliminar') ?></th>
                <td><?= $permiso->eliminar ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $permiso->estad ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($permiso->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($permiso->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($permiso->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($permiso->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
