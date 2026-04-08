<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filasventanilla $filasventanilla
 * @var \Cake\Collection\CollectionInterface|string[] $filas
 * @var \Cake\Collection\CollectionInterface|string[] $ventanillas
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="filas add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Asociación Fila-Ventanilla') ?></h3> 
    <div class="filasventanillas form content">
        <?= $this->Form->create($filasventanilla) ?>
        <fieldset>
            <?php
                echo $this->Form->control('filaId', [
                    'label' => __('Fila'),
                    'options' => $filas,
                    'empty' => true,
                ]);
                echo $this->Form->control('ventanillaId', [
                    'label' => __('Ventanilla'),
                    'options' => $ventanillas,
                    'empty' => true,
                ]);
                echo $this->Form->control('estado');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>