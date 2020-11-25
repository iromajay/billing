<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Franchises;
/* @var $this yii\web\View */
/* @var $model app\models\Center */
/* @var $form yii\widgets\ActiveForm */
$franchises = ArrayHelper::map(Franchises::find()->all(),'id','name');
?>

<div class="center-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'center_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'franchise_id')->dropDownList($franchises,['prompt'=>'Select franchise']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
