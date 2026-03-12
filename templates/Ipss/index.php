<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ips> $ipss
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="ipss index content">
    <?php if (!empty($cachePermisos[$controller]['crear'])) : ?>
        <?= $this->Html->link(__('Nuevo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ipss') ?></h3>
    <div class="ipss index content">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Id') ?></th>
                        <th><?= $this->Paginator->sort('Código REPS') ?></th>
                        <th><?= $this->Paginator->sort('NIT') ?></th>
                        <th><?= $this->Paginator->sort('IPS') ?></th>
                        <th><?= $this->Paginator->sort('Estado') ?></th>
                        <th><?= $this->Paginator->sort('Creado') ?></th>
                        <th><?= $this->Paginator->sort('Modificado') ?></th>
                        <th class="actions"><?= __('Visualizar') ?></th>
                        <th class="actions"><?= __('Edición') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ipss as $ips): ?>
                    <tr>
                        <td><?= $this->Number->format($ips->id) ?></td>
                        <td><?= h($ips->codigoReps) ?></td>
                        <td><?= h($ips->nit) ?></td>
                        <td><?= h($ips->ips) ?></td>
                        <td><?= h($ips->estado) ?></td>
                        <td><?= h($ips->created) ?></td>
                        <td><?= h($ips->modified) ?></td>
                        <td>
                            <?= $this->Form->create(null, [
                                'url' => ['action' => 'verIps', $ips->id],
                                'type' => 'post',
                                'style' => 'display:inline'
                            ]) ?>
                            <?= $this->Form->button(__('Ver'), ['class' => 'boton-oscuro']) ?>
                            <?= $this->Form->end() ?>
                        </td>
                        <td>
                            <?= $this->Form->create(null, [
                                'url' => ['action' => 'editarIps', $ips->id],
                                'type' => 'post',
                                'style' => 'display:inline'
                            ]) ?>
                            <?= $this->Form->button(__('Editar'), ['class' => 'boton-oscuro']) ?>
                            <?= $this->Form->end() ?>
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
