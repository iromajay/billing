<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Center;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
$roles = ['Admin'=>'Admin','Typist'=>"Typist",'Receptionist'=>"Receptionist"];
// $role1 = \Yii::$app->authManager->getRolesByUser(1);
// // echo "role:array_keys($role1)[0]";
// echo $model->user_id;die;
// print_r(array_keys($role1));die;
$centers = ArrayHelper::map(Center::find()->all(),'id','center_name');
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-md-6">
    <?= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput() ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'center_id')->dropDownList($centers,['prompt'=>'Select Center']) ?>
    
    <?= $form->field($model, 'name')->dropDownList($roles,['prompt'=>'Select Role']) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
