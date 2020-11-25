<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Franchises */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="franchises-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-md-4">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
<style>
.footer {
    margin-top: 80% ;
    bottom: 0 !important;
    /* position: absolute !important; */
    /* height: 100%; */
}
</style>
