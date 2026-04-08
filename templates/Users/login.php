<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';

?>
<div class="login-container row" style="justify-content: center; align-items: center;">
    <div class="column-responsive column-30">
        <div class="consulta form content">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create() ?>
            <fieldset>
                <center><h3><?= __('Por favor ingrese su usuario y clave') ?></h3></center>
                <?= $this->Form->control('usuario', ['required' => true]) ?>
                <?= $this->Form->control('password', ['required' => true]) ?>
            </fieldset>
            <?= $this->Form->submit(__('Iniciar Sesión')); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
