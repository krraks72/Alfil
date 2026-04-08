<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $tipos
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="users add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Usuario') ?></h3>
    <div class="users form content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <?php
                echo $this->Form->control('nombre', ['label' => __('Nombre')]);
                echo $this->Form->control('tipoId', ['label' => __('Tipo Documento'), 'options' => $tipos, 'empty' => true]);
                echo $this->Form->control('documento', ['label' => __('Documento')]);
                echo $this->Form->control('celular', ['label' => __('Número Celular')]);
                echo $this->Form->control('roleId', ['label' => __('Rol'), 'options' => $roles, 'empty' => true]);
                echo $this->Form->control('email', ['label' => __('Email')]);
                echo $this->Form->control('usuario', ['label' => __('Usuario')]);
                echo $this->Form->control('password', ['label' => __('Password')]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
