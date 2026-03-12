<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Municipio $municipio
 * @var \Cake\Collection\CollectionInterface|string[] $departamentos
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="municipios add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Municipio') ?></h3>
    <div class="municipios form content">
        <?= $this->Form->create($municipio) ?>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('municipio', ['label' => __('Municipio')]);
                echo $this->Form->control('departamentoId', ['label' => __('Departamento'), 'options' => $departamentos, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
