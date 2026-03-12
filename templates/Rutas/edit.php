<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="rutas edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Ruta') ?></h3>
    <div class="rutas form content">
        <?= $this->Form->create($ruta) ?>
        <h3><?= 'Ruta : ' . h($ruta->ruta) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigo');
                echo $this->Form->control('ruta');
                echo $this->Form->control('estado');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
