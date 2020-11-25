<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
// use app\models\Center;
use app\models\Franchises;
/* @var $this yii\web\View */
/* @var $model app\models\Pricing */
/* @var $form yii\widgets\ActiveForm */
// $centers = ArrayHelper::map(Center::find()->all(),'id','center_name');
$franchises = ArrayHelper::map(Franchises::find()->all(),'id','name');
if($model->center_id) {
    $centers = [$model->center_id=>$model->center->center_name];
}
else{
    $centers=[];
}
?>

<div class="pricing-form">
<div class="col-md-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'franchise_id')->dropDownList($franchises,["prompt"=>'Select Franchise']) ?>

    <?= $form->field($model, 'center_id')->dropDownList($centers,["prompt"=>"Select Center"]) ?>

    <?= $form->field($model, 'ctType1Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'ctType2Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'ctType3Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'ctType4Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'ctType5Price')->textInput(['value'=>0]) ?>

    <?= $form->field($model, 'MRI1Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'MRI2Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'MRI3Price')->textInput(['value'=>0]) ?>

    <?= $form->field($model, 'XRAY1Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'XRAY2Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'XRAY3Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'XRAY4Price')->textInput(['value'=>0]) ?>
    <?= $form->field($model, 'XRAY5Price')->textInput(['value'=>0]) ?>


    <!-- <?//= $form->field($model, 'price')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
<?php
$this->registerJs('
$("#pricing-franchise_id").append(`$<option value="SELF">SELF</oprion>`);
$(document).on("change","#pricing-franchise_id",function(){
    $.ajax({
        url:"'.Url::to(["patient-entry/centers"]).'",
        data:{franchise_id:this.value},
        dataType:"json",
        success: function(data) {
            // console.log(data);
            const centers = $("#centers");
            $("#pricing-center_id").empty();
            $("#pricing-center_id").append(`$<option value="">Select Center</oprion>`);
            Object.keys(data).forEach(key=>{
                // console.log(key,data[key]);
                var option = `$<option value=${key}>${data[key]}</oprion>`;
                $("#pricing-center_id").append(option);
            });
        }
    });
});
');