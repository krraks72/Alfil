<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Especialidade $especialidade
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="especialidades add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Especialidad') ?></h3> 
    <div class="especialidades form content">
        <?= $this->Form->create($especialidade) ?>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('especialidad', ['label' => __('Especialidad')]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
