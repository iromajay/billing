<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AuthAssignment;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-entry-index">

    <h1><?= Html::encode($this->title) ?></h1>
<br><br>

    <p>
        <?php
        $role = AuthAssignment::Role();
         if ($role=="Admin") {
            echo Html::a('Add Patient Details', ['create'], ['class' => 'btn btn-success']) ;
            $columns = [
                ['class' => 'yii\grid\SerialColumn'],
    
                // 'id',
                [ 
                    'attribute' =>  'franchise_id',
                    'value' => function($model) {
                        if(isset($model->franchise->name))
                            return $model->franchise->name;
                        return "SELF";
                    }
                  ],
                [ 
                    'attribute' =>  'center_id',
                    'value' => function($model) {
                        return $model->center->center_name;
                    }
                  ],
                'template_names',
                  
                'patient_name',
                // 'patient_age',
                // 'gender',
                // 'address:ntext',
                //'template_ids',
                'price',
               [ 
                 'attribute' =>  'typist_id',
                 'value' => function($model) {
                     return $model->typist->employee_name;
                 }
               ],

              
                   
                //'created_at',
                [
                    'attribute' => 'updated_at',
                    'value'=> function($model) {
                        return date('d-m-Y',$model->updated_at);
                    },
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updated_at',
                        'template' => '{addon}{input}',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy'
                            ]
                 ]),
                ],
                // [
                //    'attribute' => 'updated_at',
                //    'value'=> function($model) {
                //         return date('d-m-Y',$model->updated_at);
                //     }
                // ],
                //'created_by',
                //'updated_by',
    
                 ['class' => 'yii\grid\ActionColumn',],
            ];
        }
        else if($role=="Receptionist") {
            {
                echo Html::a('Add Patient Details', ['create'], ['class' => 'btn btn-success']) ;
                $columns = [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    // 'id',
                    [ 
                        'attribute' =>  'franchise_id',
                        'value' => function($model) {
                            if(isset($model->franchise->name))
                                return $model->franchise->name;
                            return "SELF";
                        }
                      ],
                    [ 
                        'attribute' =>  'center_id',
                        'value' => function($model) {
                            return $model->center->center_name;
                        }
                      ],
                    'template_names',
                      
                    'patient_name',
                    // 'patient_age',
                    // 'gender',
                    // 'address:ntext',
                    //'template_ids',
                    'price',
                   [ 
                     'attribute' =>  'typist_id',
                     'value' => function($model) {
                         return $model->typist->employee_name;
                     }
                   ],
    
                  
                       
                    //'created_at',
                    [
                        'attribute' => 'updated_at',
                        'value'=> function($model) {
                            return date('d-m-Y',$model->updated_at);
                        },
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'updated_at',
                            'template' => '{addon}{input}',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-M-yyyy'
                                ]
                     ]),
                    ],
                    // [
                    //    'attribute' => 'updated_at',
                    //    'value'=> function($model) {
                    //         return date('d-m-Y',$model->updated_at);
                    //     }
                    // ],
                    //'created_by',
                    //'updated_by',
        
                    //  ['class' => 'yii\grid\ActionColumn',],
                ];
            }
        }
        else 
            $columns = [
                ['class' => 'yii\grid\SerialColumn'],
    
                // 'id',
                'patient_name',
                'template_names',
                [
                    'attribute' => 'updated_at',
                    'value'=> function($model) {
                        return date('d-m-Y',$model->updated_at);
                    },
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updated_at',
                        'template' => '{addon}{input}',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy'
                            ]
                 ]),
                ],
                // 'patient_age',
                // 'gender',
                // 'address:ntext',
                //'template_ids',
                // 'price',
            //    [ 
            //      'attribute' =>  'typist_id',
            //      'value' => function($model) {
            //          return $model->typist->employee_name;
            //      }
            //    ],
                   
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
    
                // ['class' => 'yii\grid\ActionColumn',],
            ];
        ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>


</div>
