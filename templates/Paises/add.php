<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Paise $paise
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="paises add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear País') ?></h3>
    <div class="paises form content">
        <?= $this->Form->create($paise) ?>
        <fieldset>
            <?php
                echo $this->Form->control('pais', ['label' => __('País')]);
                echo $this->Form->control('name', ['label' => __('Nombre')]);
                echo $this->Form->control('iso2', ['label' => __('ISO2')]);
                echo $this->Form->control('iso3', ['label' => __('ISO3')]);
                echo $this->Form->control('codePhone', ['label' => __('Código Telefonía')]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
