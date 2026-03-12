<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Alfil - Sistema Integral de Información para la gestión de atención al usuario';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'fonts']) ?>
    <?= $this->Html->css('style') ?>

    <?= $this->Html->script('functions.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?php if (!($controller === 'Users' && $action === 'login')): ?>
        <nav class="menu-container">
            <div class="top-nav">
                <div class="top-nav-title">
                    <a href="<?= $this->Url->build('/Home/index') ?>"><span>Al</span>fil</a>
                </div>

                <?php if (!($controller === 'Digiturnos' && $action === 'index')): ?>
                    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
                
                    <div class="top-nav-links">
                        <?= $this->Html->link(__('Password'), ['controller' => 'Users', 'action' => 'find']) ?>
                        <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div id="menuContent" class="menu-content">
                <ul class="menu-list">
                    <?php if (!($controller === 'Digiturnos' && $action === 'index')): ?>
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                    <?php endif; ?>

                    <?php foreach ($permisosArray as $modulo => $opciones): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"><?= h($modulo) ?></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($opciones as $opcion => $permisos) : ?>
                                    <?php if (!empty($permisos['leer'])) : ?>
                                        <li><?= $this->Html->link($permisos['etiqueta'], ['controller' => $opcion, 'action' => 'index']) ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (($modulo === 'Seguridad')): ?>    
                                    <li><?= $this->Html->link('Password', ['controller' => 'Users', 'action' => 'find']) ?></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    <?php endif;?>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
<script>
    function toggleMenu() {
        document.getElementById("menuContent").classList.toggle("active");
    }
</script>