<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Paise $paise
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="paises view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarPaise', $paise->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($paise->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $paise->id], ['confirm' => __('¿Está seguro de inactivar el país # {0}?', $paise->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($paise->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $paise->id], ['confirm' => __('¿Está seguro de activar el país # {0}?', $paise->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver País') ?></h3>
    <div class="paises view content">
        <h3><?= h($paise->pais) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($paise->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Pais') ?></th>
                <td><?= h($paise->pais) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($paise->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($paise->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($paise->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($paise->usuarioMod) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $paise->estado ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
    </div>
</div>
