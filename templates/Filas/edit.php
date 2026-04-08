<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fila $fila
 * @var string[]|\Cake\Collection\CollectionInterface $generos
 * @var string[]|\Cake\Collection\CollectionInterface $prioridades
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

if ($controller === 'Filas' && $action === 'edit') {
    echo $this->Html->script('validarFila');
}

?>
<div class="filas edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Fila') ?></h3>
    <div class="filas form content">
        <?= $this->Form->create($fila) ?>
        <h3><?= 'Código : ' . h($fila->codigo) . ' - ' . 'Fila : ' . h($fila->fila) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigo', ['label' => __('Código')]);
                echo $this->Form->control('fila', ['label' => __('Fila')]);
                echo $this->Form->control('prioritaria', [
                    'label' => __('Valida Prioridad'),
                    'type' => 'checkbox',
                    'id' => 'prioritaria'
                ]);
                echo $this->Form->control('prioridadeId', [
                    'label' => __('Prioridad'),
                    'options' => $prioridades,
                    'empty' => true,
                    'id' => 'prioridade-id',
                    'disabled' => true
                ]);
                echo $this->Form->control('validaGenero', [
                    'label' => __('Valida Género'),
                    'type' => 'checkbox',
                    'id' => 'valida-genero'
                ]);
                echo $this->Form->control('generoId', [
                    'label' => __('Género'),
                    'options' => $generos,
                    'empty' => true,
                    'id' => 'genero-id',
                    'disabled' => true
                ]);
                echo $this->Form->control('infancia', ['label' => __('Valida Primera Infancia')]);
                echo $this->Form->control('discapacidad', ['label' => __('Valida Discapacidad')]);
                echo $this->Form->control('edad', [
                    'label' => __('Edad'),
                    'type' => 'checkbox',
                    'id' => 'valida-edad'
                ]);
                echo $this->Form->control('edadInicial', [
                    'label' => __('Edad Inicial'),
                    'id' => 'edad-inicial',
                    'disabled' => true
                ]);
                echo $this->Form->control('edadFinal', [
                    'label' => __('Edad Final'),
                    'id' => 'edad-final',
                    'disabled' => true
                ]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>