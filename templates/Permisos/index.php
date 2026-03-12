<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Permiso> $permisos
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="permisos index content">
    <?php if (!empty($cachePermisos[$controller]['crear'])) : ?>
        <?= $this->Html->link(__('Nuevo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Permisos') ?></h3>
    <div class="permisos form content">
        <?= $this->Form->create($permiso) ?>
        <fieldset>
            <?php
                echo $this->Form->control('perfileId', ['options' => $perfiles, 'empty' => true]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Buscar')) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="perfiles index content">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Id') ?></th>
                        <th><?= $this->Paginator->sort('Perfil') ?></th>
                        <th><?= $this->Paginator->sort('Opción') ?></th>
                        <th><?= $this->Paginator->sort('Leer') ?></th>
                        <th><?= $this->Paginator->sort('Editar') ?></th>
                        <th><?= $this->Paginator->sort('Crear') ?></th>
                        <th><?= $this->Paginator->sort('Eliminar') ?></th>
                        <th><?= $this->Paginator->sort('Estado') ?></th>
                        <th class="actions"><?= __('Visualizar') ?></th>
                        <th class="actions"><?= __('Editar') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permisos as $permiso): ?>
                    <tr>
                        <td><?= $this->Number->format($permiso->id) ?></td>
                        <td><?= h($permiso->perfile->perfil) ?></td>
                        <td><?= h($permiso->opcione->opcion) ?></td>
                        <td><?= h($permiso->leer) ?></td>
                        <td><?= h($permiso->editar) ?></td>
                        <td><?= h($permiso->crear) ?></td>
                        <td><?= h($permiso->eliminar) ?></td>
                        <td><?= h($permiso->estado) ?></td>
                        <td>
                            <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
                                <?= $this->Form->create(null, [
                                    'url' => ['action' => 'verPermiso', $permiso->id],
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
                                    'url' => ['action' => 'editarPermiso', $permiso->id],
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
            <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, registro {{current}} de {{count}}')) ?></p>
        </div>
    </div>
</div>
