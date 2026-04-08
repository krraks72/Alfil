<?php
/**
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Alfil: Software escencial pata la atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<div class="digiturnos index content">
    <h3><?= __('Digiturno') ?></h3>
    <div class="digiturnos form content">
        <?= $this->Form->create(null, ['id' => 'formDocumento']) ?>
        <div>
            <?= $this->Form->control('documento', ['label' => 'Documento', 'id' => 'campoDocumento', 'readonly' => true]) ?>
        </div>

        <div class="tecladoNumerico">
            <?php
            for ($i = 1; $i <= 9; $i++) {
                echo "<button type='button' class='tecla' data-num='{$i}'>{$i}</button>";
            }
            ?>
            
            <button type="button" class="tecla" id="borrar">(←)</button>
            <button type="button" class="tecla" data-num="0">0</button>
            <button type="submit" class="tecla tecla-ok">OK</button>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
