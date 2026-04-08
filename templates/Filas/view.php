<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fila $fila
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
            'url' => ['action' => 'editarFila', $fila->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($fila->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $fila->id], ['confirm' => __('¿Está seguro de inactivar la fila # {0}?', $fila->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($fila->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $fila->id], ['confirm' => __('¿Está seguro de activar la fila # {0}?', $fila->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Fila') ?></h3>
    <div class="filas view content">
        <h3><?= h($fila->codigo) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($fila->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Codigo') ?></th>
                <td><?= h($fila->codigo) ?></td>
            </tr>
            <tr>
                <th><?= __('fila') ?></th>
                <td><?= h($fila->fila) ?></td>
            </tr>
            <tr>
                <th><?= __('Prioritaria') ?></th>
                <td><?= $fila->prioritaria ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Prioridad') ?></th>
                <td><?= $fila->has('prioridade') ? $this->Html->link($fila->prioridade->prioridad, ['controller' => 'Prioridades', 'action' => 'view', $fila->prioridade->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Valida Genero') ?></th>
                <td><?= $fila->validaGenero ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Género') ?></th>
                <td><?= $fila->has('genero') ? $this->Html->link($fila->genero->genero, ['controller' => 'Generos', 'action' => 'view', $fila->genero->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Infancia') ?></th>
                <td><?= $fila->validaGenero ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Discapacidad') ?></th>
                <td><?= $fila->validaGenero ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Edad') ?></th>
                <td><?= $fila->edad ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Edad Inicial') ?></th>
                <td><?= $fila->edadInicial === null ? '' : $this->Number->format($fila->edadInicial) ?></td>
            </tr>
            <tr>
                <th><?= __('Edad Final') ?></th>
                <td><?= $fila->edadFinal === null ? '' : $this->Number->format($fila->edadFinal) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $fila->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($fila->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($fila->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($fila->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($fila->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>