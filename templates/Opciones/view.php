<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Opcione $opcione
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="opciones view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarOpcione', $opcione->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($opcione->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $opcione->id], ['confirm' => __('¿Está seguro de inactivar la opción # {0}?', $opcione->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($opcione->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $opcione->id], ['confirm' => __('¿Está seguro de activar la opción # {0}?', $opcione->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Opcione') ?></h3>
    <div class="opciones view content">
        <h3><?= h($opcione->opcion) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($opcione->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Opción') ?></th>
                <td><?= h($opcione->opcion) ?></td>
            </tr>
            <tr>
                <th><?= __('Etiqueta Frontal') ?></th>
                <td><?= h($opcione->etiqueta) ?></td>
            </tr>
            <tr>
                <th><?= __('Modulo') ?></th>
                <td><?= h($opcione->modulo->modulo) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $opcione->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($opcione->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($opcione->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($opcione->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($opcione->usuarioMod) ?></td>
            </tr>
        </div>
    </div>
</div>
