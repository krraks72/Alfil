<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Fila> $filas
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="filas index content">
    <?php if (!empty($cachePermisos[$controller]['crear'])) : ?>
        <?= $this->Html->link(__('Nuevo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Filas') ?></h3>
    <div class="filas index content">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Id') ?></th>
                        <th><?= $this->Paginator->sort('Código') ?></th>
                        <th><?= $this->Paginator->sort('Fila') ?></th>
                        <th><?= $this->Paginator->sort('Prioridad') ?></th>
                        <th><?= $this->Paginator->sort('Género') ?></th>
                        <th><?= $this->Paginator->sort('Infancia') ?></th>
                        <th><?= $this->Paginator->sort('Discapacidad') ?></th>
                        <th><?= $this->Paginator->sort('Edad') ?></th>
                        <th><?= $this->Paginator->sort('Estado') ?></th>
                        <th class="actions"><?= __('Visualizar') ?></th>
                        <th class="actions"><?= __('Edición') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filas as $fila): ?>
                    <tr>
                        <td><?= $this->Number->format($fila->id) ?></td>
                        <td><?= h($fila->codigo) ?></td>
                        <td><?= h($fila->fila) ?></td>
                        <td><?= h($fila->has('prioridade') ? $fila->prioridade->prioridad : '') ?></td>
                        <td><?= h($fila->has('genero') ? $fila->genero->genero : '') ?></td>                    
                        <td><?= h($fila->infancia) ?></td>                    
                        <td><?= h($fila->discapacidad) ?></td>    
                        <td><?= h($fila->edad) ?></td>
                        <td><?= h($fila->estado) ?></td>
                        <td>
                            <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
                                <?= $this->Form->create(null, [
                                    'url' => ['action' => 'verFila', $fila->id],
                                    'type' => 'post',
                                    'style' => 'display:inline'
                                ]) ?>
                                <?= $this->Form->button(__('Ver'), ['class' => 'boton-oscuro']) ?>
                                <?= $this->Form->end() ?>
                            <?php endif; ?>    
                        </td>
                        <td>
                            <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
                                <?= $this->Form->create(null, [
                                    'url' => ['action' => 'editarFila', $fila->id],
                                    'type' => 'post',
                                    'style' => 'display:inline'
                                ]) ?>
                                <?= $this->Form->button(__('Editar'), ['class' => 'boton-oscuro']) ?>
                                <?= $this->Form->end() ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('Primera')) ?>
                <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                <?= $this->Paginator->numbers(['modulus' => 2]) ?>
                <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
                <?= $this->Paginator->last(__('Última') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, registritro {{current}} de {{count}}')) ?></p>
        </div>
    </div>
</div>