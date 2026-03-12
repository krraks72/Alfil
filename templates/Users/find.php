<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';

?>
<div class="users find content">
    <h3><?= __('Cambiar Password') ?></h3>    
    <div class="users find content">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Id') ?></th>
                        <th><?= $this->Paginator->sort('Documento') ?></th>
                        <th><?= $this->Paginator->sort('Nombre') ?></th>
                        <th><?= $this->Paginator->sort('Usuario') ?></th>
                        <th class="actions"><?= __('Acciones') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->documento) ?></td>
                        <td><?= h($user->nombre) ?></td>
                        <td><?= h($user->usuario) ?></td>
                        <td>
                            <?= $this->Form->create(null, [
                                    'url' => ['action' => 'cambiarPassword', $user->id],
                                    'type' => 'post',
                                    'style' => 'display:inline'
                                ]) ?>
                                <?= $this->Form->button(__('Password'), ['class' => 'boton-oscuro']) ?>
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
