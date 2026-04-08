<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Especialidade $especialidade
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="especialidades view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarEspecialidade', $especialidade->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($especialidade->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $especialidade->id], ['confirm' => __('¿Está seguro de inactivar la especialidad # {0}?', $especialidade->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($especialidade->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $especialidade->id], ['confirm' => __('¿Está seguro de activar la especialidad # {0}?', $especialidade->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Especialidad') ?></h3>
    <div class="especialidades view content">
        <h3><?= h($especialidade->codigo) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($especialidade->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Código') ?></th>
                <td><?= h($especialidade->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('Especialidad') ?></th>
                <td><?= h($especialidade->especialidad) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $especialidade->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($especialidade->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($especialidade->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($especialidade->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($especialidade->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
