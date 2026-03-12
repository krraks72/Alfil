<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Paise> $paises
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="paises index content">
    <?php if (!empty($cachePermisos[$controller]['crear'])) : ?>
        <?= $this->Html->link(__('Nuevo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Paises') ?></h3>
    <div class="paises index content">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Id') ?></th>
                        <th><?= $this->Paginator->sort('País') ?></th>
                        <th><?= $this->Paginator->sort('Estado') ?></th>
                        <th><?= $this->Paginator->sort('Creado') ?></th>
                        <th><?= $this->Paginator->sort('Modificado') ?></th>
                        <th class="actions"><?= __('Visualizar') ?></th>
                        <th class="actions"><?= __('Edición') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paises as $paise): ?>
                    <tr>
                        <td><?= $this->Number->format($paise->id) ?></td>
                        <td><?= h($paise->pais) ?></td>
                        <td><?= h($paise->estado) ?></td>
                        <td><?= h($paise->created) ?></td>
                        <td><?= h($paise->modified) ?></td>
                        <td>
                            <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
                                <?= $this->Form->create(null, [
                                    'url' => ['action' => 'verPaise', $paise->id],
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
                                    'url' => ['action' => 'editarPaise', $paise->id],
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
