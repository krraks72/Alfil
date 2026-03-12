<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Municipio $municipio
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="municipios view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarMunicipio', $municipio->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($municipio->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $municipio->id], ['confirm' => __('¿Está seguro de inactivar el municipio # {0}?', $municipio->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($municipio->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $municipio->id], ['confirm' => __('¿Está seguro de activar el municipio # {0}?', $municipio->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Municipio') ?></h3>
    <div class="municipios view content">
        <h3><?= h($municipio->municipio) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($municipio->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Código') ?></th>
                <td><?= h($municipio->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('Municipio') ?></th>
                <td><?= h($municipio->municipio) ?></td>
            </tr>
            <tr>
                <th><?= __('Departamento') ?></th>
                <td><?= h($municipio->departamento->departamento) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $municipio->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($municipio->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($municipio->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modifcado') ?></th>
                <td><?= h($municipio->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($municipio->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
