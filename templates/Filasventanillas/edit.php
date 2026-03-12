<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filasventanilla $filasventanilla
 * @var string[]|\Cake\Collection\CollectionInterface $filas
 * @var string[]|\Cake\Collection\CollectionInterface $ventanillas
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="filasventanillas edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar asociación Fila-Ventanilla') ?></h3>
        <div class="filasventanillas form content">
        <?= $this->Form->create($filasventanilla) ?>
        <fieldset>
            <?php
               echo $this->Form->control('filaId', [
                    'label' => __('Fila'),
                    'options' => $filas,
                    'empty' => true,
                ]);
                echo $this->Form->control('ventanillaId', [
                    'label' => __('Ventanilla'),
                    'options' => $ventanillas,
                    'empty' => true,
                ]);
                echo $this->Form->control('estado');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>