<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prioridade $prioridade
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="prioridades add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Prioridad') ?></h3>
    <div class="prioridades form content">
        <?= $this->Form->create($prioridade) ?>
        <fieldset>
            <?php
                echo $this->Form->control('prioridad', ['label' => __('Prioridad')]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
