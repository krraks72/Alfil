<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Opcione $opcione
 * @var \Cake\Collection\CollectionInterface|string[] $modulos
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="opciones add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Opción') ?></h3>
    <div class="opciones form content">
        <?= $this->Form->create($opcione) ?>
        <fieldset>
            <?php
                echo $this->Form->control('opcion', ['label' => __('Opción')]);
                echo $this->Form->control('etiqueta', ['label' => __('Etiqueta Frontal')]);
                echo $this->Form->control('moduloId', ['label' => __('Módulo'), 'options' => $modulos, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
