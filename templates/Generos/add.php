<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Genero $genero
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="generos add content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Crear Género') ?></h3>
    <div class="generos form content">
        <?= $this->Form->create($genero) ?>
        <fieldset>
            <?php
                echo $this->Form->control('genero', ['label' => __('Género')]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
