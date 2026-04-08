<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sala $sala
 * @var \Cake\Collection\CollectionInterface|string[] $sedes
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="salas edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Sala') ?></h3>
    <div class="salas form content">
        <?= $this->Form->create($sala) ?>
        <h3><?= 'Código : ' . h($sala->codigo) . ' - ' . 'Sala : ' . h($sala->sala) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('sala', ['label' => __('Sala')]);
                echo $this->Form->control('sedeId', ['label' => __('Sede'), 'options' => $sedes, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
