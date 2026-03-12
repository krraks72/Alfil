<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 * @var \Cake\Collection\CollectionInterface|string[] $municipios
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="empresas add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Empresa') ?></h3>
    <div class="empresas form content">
        <?= $this->Form->create($empresa) ?>
        <fieldset>
            <?php
                echo $this->Form->control('razonSocial', ['label' => __('Razón Social')]);
                echo $this->Form->control('nit', ['label' => __('NIT')]);
                echo $this->Form->control('digito', ['label' => __('Dígito de Veriricación')]);
                echo $this->Form->control('representante', ['label' => __('Representante Legal')]);
                echo $this->Form->control('direccion', ['label' => __('Dirección')]);
                echo $this->Form->control('telefono', ['label' => __('Número Telefónico')]);
                echo $this->Form->control('municipioId', ['label' => __('Municipio'), 'options' => $municipios, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
