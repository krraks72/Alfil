<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Permiso $permiso
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="permisos edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Permiso') ?></h3>
    <div class="permisos form content">
        <?= $this->Form->create($permiso) ?>
        <h3><?= 'Permiso ' . ' - ' . 'Perfil : ' . h($permiso->perfile->perfil) . ' - ' . 'Opción : ' . h($permiso->opcione->opcion) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('perfileId', ['label' => __('Perfil'), 'options' => $perfiles, 'empty' => true]);
                echo $this->Form->control('opcioneId', ['label' => __('Opción'), 'options' => $opciones, 'empty' => true]);
                echo $this->Form->control('leer', ['label' => __('Leer')]);
                echo $this->Form->control('crear', ['label' => __('Crear')]);
                echo $this->Form->control('editar', ['label' => __('Editar')]);
                echo $this->Form->control('eliminar', ['label' => __('Eliminar')]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
