<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Departamento $departamento
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="departamentos view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarDepartamento', $departamento->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($departamento->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $departamento->id], ['confirm' => __('¿Está seguro de inactivar el departamento # {0}?', $departamento->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($departamento->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $departamento->id], ['confirm' => __('¿Está seguro de activar el departamento # {0}?', $departamento->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Departamento') ?></h3>
    <div class="departamentos view content">
        <h3><?= h($departamento->departamento) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= h($departamento->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Código') ?></th>
                <td><?= h($departamento->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('Departamento') ?></th>
                <td><?= h($departamento->departamento) ?></td>
            </tr>
            <tr>
                <th><?= __('País') ?></th>
                <td><?= h($departamento->paise->pais) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $departamento->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($departamento->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($departamento->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($departamento->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($departamento->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
