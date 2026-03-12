<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filasruta $filasruta
 * @var \Cake\Collection\CollectionInterface|string[] $rutas
 * @var \Cake\Collection\CollectionInterface|string[] $filas
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="filas add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Asociación Fila-Ruta') ?></h3> 
    <div class="filasrutas form content">
        <?= $this->Form->create($filasruta) ?>
        <fieldset>
            <?php
                echo $this->Form->control('rutaId', [
                    'label' => __('Ruta'),
                    'options' => $rutas,
                    'empty' => true,
                ]);
                echo $this->Form->control('filaId', [
                    'label' => __('Fila'),
                    'options' => $filas,
                    'empty' => true,
                ]);
                echo $this->Form->control('estado');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
