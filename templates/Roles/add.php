<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 * @var \Cake\Collection\CollectionInterface|string[] $perfiles
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="roles add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Rol') ?></h3>
    <div class="roles form content">
        <?= $this->Form->create($role) ?>
        <fieldset>
            <?php
                echo $this->Form->control('rol', ['label' => __('Rol')]);
                echo $this->Form->control('perfileId', ['label' => __('Perfil'), 'options' => $perfiles, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
