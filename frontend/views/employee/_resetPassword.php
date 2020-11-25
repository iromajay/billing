<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
$roles = ['admin'=>'Admin','sub_staff'=>"Sub Staff",'staff'=>"Staff"];
// $role1 = \Yii::$app->authManager->getRolesByUser(1);
// // echo "role:array_keys($role1)[0]";
// echo $model->user_id;die;
// print_r(array_keys($role1));die;

?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'password')->passwordInput(['style'=>'width:190px;','placeholder'=>'password'])->label(false) ?>

    <input type="password" id="confirm_password" placeholder="confirm password" style="margin-bottom:20px ;">

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    var password = document.getElementById("employee-password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
