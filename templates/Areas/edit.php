<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Area $area
 * @var \Cake\Collection\CollectionInterface|string[] $ipss
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="areas edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Area') ?></h3>
    <div class="areas form content">
        <?= $this->Form->create($area) ?>
        <h3><?= 'Código : ' . h($area->codigo) . ' - ' . 'Area : ' . h($area->area) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('area', ['label' => __('Area')]);
                echo $this->Form->control('ipsId', ['label' => __('IPS'), 'options' => $ipss, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>