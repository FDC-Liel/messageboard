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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>MessageBoard</title>
    <?php
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('dropify.min');
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery-ui.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('dropify.min');
    ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

    <div class="container-fluid">
        <header class="text-center bg-primary text-white py-3">
            <!-- Add your logo or image here -->
            <!-- <img src="/img/logo.png" alt="Your Logo" class="logo"> -->
            <h1>Message Board</h1>
        </header>

        <!-- CONTENT -->
        <div id="content" class="mt-4">
            <div style="display: flex; justify-content: space-between;">
                <?php if ($logged_in): ?>
                    <ul class="navbar">
                        <li class="nav-item">
                            <?php echo $this->Html->link('Message Board', array('controller'=>'users', 'action'=>'index'), array('class' => 'navbar-brand')); ?>
                        </li>
                        <li class="nav-item mx-4">
                            <?php echo $this->Html->link('Message List', array('controller'=>'messages', 'action'=>'index')); ?>
                        </li>
                        <li class="nav-item mx-4">
                            <?php echo $this->Html->link('Edit Profile', array('controller'=>'users', 'action'=>'edit', $current_user['User']['id'])); ?>
                        </li>
                    </ul>    
                    <ul class="nav">
                        <li class="nav-item mx-4">
                            <strong>
                            Welcome, <?php echo isset($current_user['User']['name']) ? h($current_user['User']['name']) : 'User' ?>
                            </strong>
                        </li>
                        <li class="nav-item">
                            <?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout')); ?>
                        </li>
                    </ul>
                <?php else: ?>
                    <!-- Add login or registration links here -->
                    <?php // echo $this->Html->link('Login', array('controller'=>'register', 'action'=>'index')); ?>
                <?php endif; ?>
            </div>

            <div class="container-fluid">
                <?php echo $this->Flash->render(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
        </div>    
    </div>

    
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>

