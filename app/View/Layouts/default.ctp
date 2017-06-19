<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));

        echo $this->Html->css('jquery-ui.min');
        echo $this->Html->css('bootstrap.min');
        //echo $this->Html->css('bootstrap-theme.min');
        echo $this->Html->css('custom');
        echo $this->Html->css('spin');

        echo $this->Html->script('jquery-1.11.3.min.js');
        echo $this->Html->script('jquery-ui.min');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('functions.js');
        echo $this->Html->script('main.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <?php echo $this->Html->link('Lectotypification', '/', array('class' => 'navbar-brand')); ?>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><?php echo $this->Html->link('Browse', '/records', array()); ?></li>
                        <?php if (!empty($logged['id'])) : ?>
                            <li><?php echo $this->Html->link('Insert', '/records/insert', array()); ?></li>
                        <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!empty($logged['id'])) : ?>
                            <li><?php echo $this->Html->link($logged['name'], array('#')); ?></li>
                            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Logout', array('controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?></li>
                        <?php else : ?>
                            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-log-in"></span> Login', array('controller' => 'users', 'action' => 'login'), array('escape' => false)); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="container" class="container">
            <div id="content">
                <?php //echo $this->Flash->render(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <footer id="footer">
            <div class="container">
                <p class="text-muted text-center">
                    <a href="http://dataflos.sav.sk:8080/bugzilla/describecomponents.cgi?product=Lectotypification">File a bug</a><br />
                    Copyright: Institute of Botany, 2016.<br/>
                    v0.8
                </p>
            </div>
        </footer>
        <?php //echo $this->element('sql_dump'); ?>
    </body>
</html>
