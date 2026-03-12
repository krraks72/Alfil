<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filasruta $filasruta
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="filas view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarFilasruta', $filasruta->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($filasruta->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $filasruta->id], ['confirm' => __('¿Está seguro de inactivar la asociación fila-ruta # {0}?', $filasruta->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($filasruta->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $filasruta->id], ['confirm' => __('¿Está seguro de activar la asociación fila-ruta # {0}?', $filasruta->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Asociación Fila-Ruta') ?></h3>
    <div class="filas view content">
        <h3><?= h($filasruta->fila->fila) . ' - ' . h($filasruta->ruta->ruta)?></h3>
        <table>                
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($filasruta->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ruta') ?></th>
                    <td><?= h($filasruta->ruta->ruta) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fila') ?></th>
                    <td><?= h($filasruta->fila->fila) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= $filasruta->estado ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Creado') ?></th>
                    <td><?= h($filasruta->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario Crea') ?></th>
                    <td><?= h($filasruta->usuarioCrea) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= h($filasruta->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario Modifica') ?></th>
                    <td><?= h($filasruta->usuarioMod) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
