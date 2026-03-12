<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Area $area
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="areas view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarArea', $area->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($area->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $area->id], ['confirm' => __('¿Está seguro de inactivar el area # {0}?', $area->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($area->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $area->id], ['confirm' => __('¿Está seguro de activar el area # {0}?', $area->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Area') ?></h3>
    <div class="areas view content">
        <h3><?= h($area->codigo) ?></h3>
        <table>            
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($area->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Código') ?></th>
                <td><?= h($area->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('Area') ?></th>
                <td><?= h($area->area) ?></td>
            </tr>
            <tr>
                <th><?= __('Ips') ?></th>
                <td><?= h($area->ips->ips) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $area->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($area->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($area->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($area->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($area->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>