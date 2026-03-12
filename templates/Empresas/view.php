<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="empresas view content">
    <?php if (!empty($cachePermisos[$controller]['leer'])) : ?>
        <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if (!empty($cachePermisos[$controller]['editar'])) : ?>
        <?= $this->Form->create(null, [
            'url' => ['action' => 'editarEmpresa', $empresa->id],
            'type' => 'post',
            'style' => 'display:inline'
        ]) ?>
        <?= $this->Form->button(__('Editar'), ['class' => 'button float-right']) ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($empresa->estado == 1)) : ?>
        <?= $this->Form->postLink(__('Inactivar'), ['action' => 'inactivar', $empresa->id], ['confirm' => __('¿Está seguro de inactivar la empresa # {0}?', $empresa->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <?php if ((!empty($cachePermisos[$controller]['eliminar'])) && ($empresa->estado == 0)) : ?>
        <?= $this->Form->postLink(__('Activar'), ['action' => 'activar', $empresa->id], ['confirm' => __('¿Está seguro de activar la empresa # {0}?', $empresa->id), 'class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Ver Empresa') ?></h3>
    <div class="empresas view content">
        <h3><?= h($empresa->razonSocial) ?></h3>
        <table>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($empresa->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Razón Social') ?></th>
                <td><?= h($empresa->razonSocial) ?></td>
            </tr>
            <tr>
                <th><?= __('Nit') ?></th>
                <td><?= h($empresa->nit) ?></td>
            </tr>
            <tr>
                <th><?= __('Representante') ?></th>
                <td><?= h($empresa->representante) ?></td>
            </tr>
            <tr>
                <th><?= __('Dirección') ?></th>
                <td><?= h($empresa->direccion) ?></td>
            </tr>
            <tr>
                <th><?= __('Teléfono') ?></th>
                <td><?= h($empresa->telefono) ?></td>
            </tr>
            <tr>
                <th><?= __('Dígito') ?></th>
                <td><?= $this->Number->format($empresa->digito) ?></td>
            </tr>
            <tr>
                <th><?= __('Municipio') ?></th>
                <td><?= h($empresa->municipio->municipio) ?></td>
            </tr>
            <tr>
                <th><?= __('Estado') ?></th>
                <td><?= $empresa->estado ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Creado') ?></th>
                <td><?= h($empresa->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Crea') ?></th>
                <td><?= h($empresa->usuarioCrea) ?></td>
            </tr>
            <tr>
                <th><?= __('Modificado') ?></th>
                <td><?= h($empresa->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Usuario Modifica') ?></th>
                <td><?= h($empresa->usuarioMod) ?></td>
            </tr>
        </table>
    </div>
</div>
