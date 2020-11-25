<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Center;
use app\models\Franchises;
$centers = ArrayHelper::map(Center::find()->all(),'id','center_name');
$franchises = ArrayHelper::map(Franchises::find()->all(),'id','name');
if($model->center_id) {
    $centers = [$model->center_id=>$model->center->center_name];
}
else{
    $centers=[];
}
?>

<div class="patient-entry-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-8">

    <?= $form->field($model, 'franchise_id')->dropDownList($franchises,["prompt"=>'Select Franchise']) ?>
    
    <?= $form->field($model, 'center_id')->dropDownList($centers,['id'=>'centers']) ?>
    <!-- <label >Center</label>
    
    <select name="PatientEntry[center_id]" id="centers" class="form-control" style="margin-bottom: 10px;"><option value="">Selcet center</option></select> -->

    <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'template_names')->dropDownList($templates,['multiple'=>'multiple','name'=>'template_names[]','class'=>'patiententry-template_names form-control']) ?>

    <!-- <?//= $form->field($model, 'template_ids')->textInput(['maxlength' => true]) ?> -->

    <!-- <?//= $form->field($model, 'price')->textInput() ?> -->

    <?= $form->field($model, 'typist_id')->dropDownList($typists,["prompt"=>"Select Typist"]) ?>
   


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <!-- <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
  <option value="AL">Alabama</option>
  <option value="WY">Wyoming</option>
</select> -->

    <?php ActiveForm::end(); ?>

</div>
<style>
/* .patiententry-template_names{
    width: 200px;
} */
</style>

<?php 
$this->registerJs('
// console.log("1");
$(".patiententry-template_names").select2();
var tempNames = "'.$model->template_names.'";
var tempIds = "'.$model->template_ids.'";
  function test(tempIds){
    if(tempNames!=="") {

        tempNames = tempNames.split(",");
        tempIds = tempIds.split(",");
        console.log(tempNames);
        console.log(tempIds);
        $(".patiententry-template_names").val("").trigger("change");
        for(var i=0;i<tempIds.length;i++) {
            var newOption = new Option(tempNames[i],tempIds[i], true, true);
            console.log(i);
            // if($(".patiententry-template_names").find("option[value="+tempIds[i]+"]").length){
            // // $(".patiententry-template_names").append(newOption).trigger("change");
            //     console.log("33");
            //    await $(".patiententry-template_names").val(tempIds[i]).trigger("change");
            // }else{
                console.log("34");
                $(".patiententry-template_names").append(newOption).trigger("change");
                $("#mySelect2").append(newOption).trigger("change");
            // }
        }
    }
}
test(tempIds);
// $(".js-example-basic-multiple").select2("data",[{id:"1",text:"test"},]);
$("#patiententry-franchise_id").append(`$<option value="SELF">SELF</oprion>`);
$(document).on("change","#patiententry-franchise_id",function(){
    $.ajax({
        url:"'.Url::to(["centers"]).'",
        data:{franchise_id:this.value},
        dataType:"json",
        success: function(data) {
            // console.log(data);
            const centers = $("#centers");
            $("#centers").empty();
            $("#centers").append(`$<option value="">Select Center</oprion>`);
            Object.keys(data).forEach(key=>{
                // console.log(key,data[key]);
                var option = `$<option value=${key}>${data[key]}</oprion>`;
                $("#centers").append(option);
            });
        }
    });
});

// $(document).on("change","#centers",function(){
//     $.ajax({
//         url:"'.Url::to(["templates"]).'",
//         data:{franchise_id:this.value},
//         dataType:"json",
//         success: function(data) {
//             console.log(data);
           
//         }
//     });
// });

');
