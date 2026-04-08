<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filasventanilla $filasventanilla
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="filasventanillas view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarFilasventanilla', $filasventanilla->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($filasventanilla->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $filasventanilla->id], ['confirm' => __('¿Está seguro de inactivar la asociación fila-ventanilla # {0}?', $filasventanilla->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($filasventanilla->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $filasventanilla->id], ['confirm' => __('¿Está seguro de activar la asociación fila-ventanilla # {0}?', $filasventanilla->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Asociación Fila-ventanilla') ?></h3>
        <div class="filasventanillas view content">
            <h3><?= h($filasventanilla->usuarioCrea) ?></h3>
            <table>                
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($filasventanilla->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fila') ?></th>
                    <td><?= h($filasventanilla->fila->fila) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ventanilla') ?></th>
                    <td><?= h($filasventanilla->ventanilla->ventanilla) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creado') ?></th>
                    <td><?= h($filasventanilla->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario Crea') ?></th>
                    <td><?= h($filasventanilla->usuarioCrea) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= h($filasventanilla->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario Modifica') ?></th>
                    <td><?= h($filasventanilla->usuarioMod) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= $filasventanilla->estado ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
