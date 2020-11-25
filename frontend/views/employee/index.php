<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<br><br>
<div class="employee-index">

    

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success openModal ','size'=>'lg', 'header'=>'Create Employee']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'employee_name',
            'address:ntext',
            'phone',
            // [
            //    'attribute' => 'user_id',
            //    'value' => function($model) {
            //        return $model->user->user_name;
            //    }
            // ],
            //'created_by',
            //'created_date',
            //'updated_by',
            //'updated_date',
            //'record_status',

            [
                'class' => 'yii\grid\ActionColumn',
                // 'template' => '{update}{view}',
                // 'buttons' => [
                //     'option'=>['class'=>'row'],
                //      'view' => function($id, $model) {
                //     return Html::a('<span "><b class="fa fa-key"></b></span>', ['employee/resetpassword', 'id' => $model['id']], ['title' => 'Reset Password', ]);
                // },
                
                // ],
                // 'contentOptions' =>[
                //     'class'=>"flexcell"
                // ],
            ],
        ],
    ]); ?>


</div>
<style>
    .flexcell{
        display: flex;
    }
</style>
