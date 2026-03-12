<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sede $sede
 * @var \Cake\Collection\CollectionInterface|string[] $municipios
 * @var \Cake\Collection\CollectionInterface|string[] $ipss
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="sedes edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Sede') ?></h3>
    <div class="sedes form content">
        <?= $this->Form->create($sede) ?>
        <h3><?= 'Código Reps : ' . h($sede->codigoReps) . ' - ' . 'Sede : ' . h($sede->sede) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigoReps', ['label' => __('Código REPS')]);
                echo $this->Form->control('habilitacion', ['label' => __('Habilitación')]);
                echo $this->Form->control('sede', ['label' => __('Sede')]);
                echo $this->Form->control('direccion', ['label' => __('Dirección')]);
                echo $this->Form->control('telefono', ['label' => __('Número Telefónico')]);
                echo $this->Form->control('municipioId', ['label' => __('Municipio'), 'options' => $municipios, 'empty' => true]);
                echo $this->Form->control('ipsId', ['label' => __('IPS'), 'options' => $ipss, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
