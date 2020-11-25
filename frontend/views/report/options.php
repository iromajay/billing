<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row container">
    <div class="col-md-2 row1 col1">
        <?= Html::a('Franchise Report', ['index'], ['class' => 'btn btn-primary','size'=>'sm', 'header'=>'Create Tax']) ?>
    </div>
    <div class="col-md-2 row1">
        <?= Html::a('Typist Report', ['typist'], ['class' => 'btn btn-primary','size'=>'sm', 'header'=>'Create Tax']) ?>
    </div>
</div>
<style>
    .row1 {
        margin-top: 100px;
    }
    .col1{
        margin-left: 200px;
    }
    .footer {
    margin-top: 80% ;
    bottom: 0 !important;
    /* position: absolute !important; */
    /* height: 100%; */
}
</style>