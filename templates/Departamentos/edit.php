<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Departamento $departamento
 * @var \Cake\Collection\CollectionInterface|string[] $paises
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="departamentos edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Departamento') ?></h3>
    <div class="departamentos form content">
        <?= $this->Form->create($departamento) ?>
        <h3><?= 'Código : ' . h($departamento->codigo) . ' - ' . 'Departamento : ' . h($departamento->departamento) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('departamento', ['label' => __('Departamento')]);
                echo $this->Form->control('paiseId', ['label' => __('País'), 'options' => $paises, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
