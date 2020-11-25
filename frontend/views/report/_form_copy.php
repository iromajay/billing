<?php
use dosamigos\datepicker\DateRangePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Reports";


use yii\helpers\ArrayHelper;
use app\models\Center;
use app\models\Franchises;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
if($model->franchise_id) {
    $centers = ArrayHelper::map(Center::find()->where(['franchise_id'=>$model->franchise_id])->all(),'id','center_name');
}
else {
    $centers = ArrayHelper::map(Center::find()->all(),'id','center_name');
}
$franchises = ArrayHelper::map(Franchises::find()->all(),'id','name');
// if($model->center_id) {
//     $centers = [$model->center_id=>$centers[$model->center_id]];
// }
// else{
//     $centers=[];
// }
// echo "$model->start_date";
?>
<?php $form = ActiveForm::begin([
    'action' => ['index-copy'],
    'method' => 'get',
]); ?>
<div class="col-md-4">
<?= $form->field($model, 'franchise_id')->dropDownList($franchises,["prompt"=>'Select Franchise']) ?>
</div>
<div class="col-md-4">
<?= $form->field($model, 'center_id')->dropDownList($centers,['prompt'=>"Selcet Center",['id'=>'centers']]) ?>
</div>
<div class="row">
<div class="col-md-4">
    <?= $form->field($model, 'start_date')->widget(DateRangePicker::class, [
        'attributeTo' => 'end_date', 
        // 'language' => 'ru',
        'labelTo' => 'to',
    //    'size' => 'lg',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-d',
            'todayHighlight' => true,
        ]
    ])->label('Select Date Range');?>                        
</div>
</div>
<button type="submit" id="btnSearch" class="btn btn-success" style="margin-left: 40%;">Submit</button>
<?= Html::a('Reset', ['index'], ['class' => 'btn btn-primary','size'=>'sm', 'header'=>'Create Tax']) ?>
<?php ActiveForm::end(); ?>


<?php $this->registerJs('
$("#report-franchise_id").append(`$<option value="SELF">SELF</oprion>`);
$(document).on("change","#report-franchise_id",function(){
    $.ajax({
        url:"'.Url::to(["patient-entry/centers"]).'",
        data:{franchise_id:this.value},
        dataType:"json",
        success: function(data) {
            // console.log(data);
            const centers = $("#report-center_id");
            $("#report-center_id").empty();
            $("#report-center_id").append(`$<option value="">Select Center</oprion>`);
            Object.keys(data).forEach(key=>{
                // console.log(key,data[key]);
                var option = `$<option value=${key}>${data[key]}</oprion>`;
                $("#report-center_id").append(option);
            });
        }
    });
});
');
?>

<style>
.footer {
    margin-top: 80% ;
    bottom: 0 !important;
    /* position: absolute !important; */
    /* height: 100%; */
}
table-striped thead tr:nth-child(2) {
    display: none;
}
</style>