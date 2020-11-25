<?php
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content" >
        <!-- <img style="width: 100%;margin-top: -14px;"  src="images/nklogo.jpeg"> -->
        <?= Alert::widget() ?>
        <div class="page-title"><?= $this->title ?></div>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer" style="background-color: #e3e1d8">
	<div class="pull-left">
         Powered by <b style="color:#4a80ba"> HADRON TECH </b>
		
	</div>
    <div class="text-right">
       <img width="70" height="70" src="images/nkgrp.png">
    </div>
</footer>
