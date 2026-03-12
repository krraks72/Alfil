<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ips $ips
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="ipss view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarIps', $ips->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($ips->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $ips->id], ['confirm' => __('¿Está seguro de inactivar la ips # {0}?', $ips->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($ips->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $ips->id], ['confirm' => __('¿Está seguro de activar la ips # {0}?', $ips->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver IPS') ?></h3>
    <div class="ipss view content">
        <h3><?= h($ips->codigoReps) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($ips->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Codigo Reps') ?></th>
                <td><?= h($ips->codigoReps) ?></td>
            </tr>
            <tr>
                <th><?= __('Sigla') ?></th>
                <td><?= h($ips->sigla) ?></td>
            </tr>
            <tr>
                <th><?= __('Nit') ?></th>
                <td><?= h($ips->nit) ?></td>
            </tr>
            <tr>
                <th><?= __('Digito de Verificación') ?></th>
                <td><?= $this->Number->format($ips->digito) ?></td>
            </tr>
            <tr>
                <th><?= __('Ips') ?></th>
                <td><?= h($ips->ips) ?></td>
            </tr>
            <tr>
                <th><?= __('Direccion') ?></th>
                <td><?= h($ips->direccion) ?></td>
            </tr>
            <tr>
                <th><?= __('Municipio') ?></th>
                <td><?= h($ips->municipio->municipio) ?></td>
            </tr>
            <tr>
                <th><?= __('Empresa') ?></th>
                <td><?= h($ips->empresa->razonSocial) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $ips->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($ips->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($ips->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($ips->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($ips->usuarioMod) ?></td>
            </tr>
        </table>    
    </div>
</div>