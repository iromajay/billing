<?php

use yii\bootstrap\Modal;

Modal::begin([
  'id'=>'modal-sm',
  'size'=>'modal-sm',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-sm-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-sm-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'modal-md',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-md-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-md-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'modal-lg',
  'size'=>'modal-lg',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-lg-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-lg-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'modal-xl',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-xl-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-xl-body"><br><br></div>';
Modal::end();

?>