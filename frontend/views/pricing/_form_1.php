<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Center;
/* @var $this yii\web\View */
/* @var $model app\models\Pricing */
/* @var $form yii\widgets\ActiveForm */
$centers = ArrayHelper::map(Center::find()->all(),'id','center_name');
?>

<div class="pricing-form">
<div class="col-md-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'center_id')->dropDownList($centers,["prompt"=>"Select Center"]) ?>

    <?= $form->field($model, 'cateogory')->dropDownList([ 'CT-type-1' => 'CT-type-1', 'CT-type-2' => 'CT-type-2', 'CT-type-3' => 'CT-type-3', 'CT-type-4' => 'CT-type-4', 'CT-type-5' => 'CT-type-5', 'MRI-type-1' => 'MRI-type-1', 'MRI-type-2' => 'MRI-type-2', 'MRI-type-3' => 'MRI-type-3', 'XRAY-type-1' => 'XRAY-type-1', 'XRAY-type-2' => 'XRAY-type-2', 'XRAY-type-3' => 'XRAY-type-3', 'XRAY-type-4' => 'XRAY-type-4', 'XRAY-type-5' => 'XRAY-type-5', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
