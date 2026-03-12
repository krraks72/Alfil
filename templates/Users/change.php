<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';

?>
<div class="users change content">
    <h3><?= __('Cambiar Password') ?></h3>
    <div class="users change content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <?php
                echo $this->Form->control('nombre', ['label' => __('Nombre'), 'readonly' => true]);
                echo $this->Form->control('codigo', ['label' => __('Tipo Documento'), 'value' => $user->tipo->codigo, 'readonly' => true]);
                echo $this->Form->control('documento', ['label' => __('Documento'), 'readonly' => true]);
                echo $this->Form->control('rol', ['label' => __('Rol'), 'value' => $user->role->rol,'disabled' => true]);
                echo $this->Form->control('usuario', ['label' => __('Usuario'), 'readonly' => true]);
                echo $this->Form->control('password', ['label' => __('Nuevo Password'), 'type' => 'password', 'value' => '']);
                echo $this->Form->control('confirPass', ['label' => __('Confirmar Password'), 'type' => 'password']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
