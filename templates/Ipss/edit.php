<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ips $ips
 * @var \Cake\Collection\CollectionInterface|string[] $municipios
 * @var \Cake\Collection\CollectionInterface|string[] $empresas
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?><div class="ipss edit content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Editar Ips') ?></h3>
    <div class="ipss form content">
        <?= $this->Form->create($ips) ?>
        <h3><?= 'Código Reps : ' . h($ips->codigoReps) . ' - ' . 'IPS : ' . h($ips->ips) ?></h3>
        <fieldset>
            <?php
                echo $this->Form->control('codigoReps', ['label' => __('Código REPS')]);
                echo $this->Form->control('sigla', ['label' => __('Sigla')]);
                echo $this->Form->control('nit', ['label' => __('NIT')]);
                echo $this->Form->control('digito', ['label' => __('Dígito de verificación')]);
                echo $this->Form->control('ips', ['label' => __('IPS')]);
                echo $this->Form->control('direccion', ['label' => __('Dirección')]);
                echo $this->Form->control('municipioId', ['label' => __('Municipio'), 'options' => $municipios, 'empty' => true]);
                echo $this->Form->control('empresaId', ['label' => __('Departamento'), 'options' => $empresas, 'empty' => true]);
                echo $this->Form->control('estado', ['label' => __('Estado')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Guardad')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
