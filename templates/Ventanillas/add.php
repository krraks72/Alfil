<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ventanilla $ventanilla
 * @var \Cake\Collection\CollectionInterface|string[] $areas
 * @var \Cake\Collection\CollectionInterface|string[] $sedes
 * @var \Cake\Collection\CollectionInterface|string[] $salas
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="ventanillas add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Ventanilla') ?></h3>
    <div class="ventanillas form content">
        <?= $this->Form->create($ventanilla) ?>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('ventanilla', ['label' => __('Ventanilla')]);
                echo $this->Form->control('areaId', ['label' => __('Area'), 'options' => $areas, 'empty' => true]);
                echo $this->Form->control('sedeId', ['label' => __('Sede'), 'options' => $sedes, 'empty' => true]);
                echo $this->Form->control('salaId', ['label' => __('Sala'), 'options' => $salas, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
