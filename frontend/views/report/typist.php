<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AuthAssignment;
use kartik\export\ExportMenu;
$this->title = "Typist Report";
?>
<div class="patient-entry-index">

    <h1><?= Html::encode($this->title) ?></h1>
<br>

<?php echo $this->render('_form_typist', ['model' => $model,'typists'=>$typists]); ?>

<br>

    <p>
        <?php
            if($role=="Admin")
                $columns = [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    // 'id',
                    [ 
                        'attribute' =>  'Franchise',
                        'value' => function($model) {
                            if(isset($model->franchise->name))
                                return $model->franchise->name;
                            return "SELF";
                        }
                      ],
                    'center.center_name',
                    // [
                    //     'attribute'=> 'Patient Name',
                    //     'filter' => false,
                    //     'value' => function($model) {
                    //         return $model->patient_name;
                    //     }
                    // ],
                    // 'patient_age',
                    // 'gender',
                    // 'address:ntext',
                    [
                    'attribute'=> 'template',
                    'filter' => false,
                    'value' => function($model) {
                            return $model->template_names;
                        },
                    ],
                    //'template_ids',
                    
                // [ 
                //     'attribute'=> 'Price',
                //     'filter' => false,
                //     'value' => function($model) {
                //         return $model->price;
                //     }
                // ],
                [ 
                    'attribute' =>  'Typist',
                    'value' => function($model) {
                        return $model->typist->employee_name;
                    },
                    'footer' => "Total Price",


                ],

                [
                    'attribute' =>  'Price',
                    'value'=>function($model) {
                        return $model->price;
                    },
                    'footer' => $sum,
                  ],
                    
                    //'created_at',
                    [
                        'attribute' => 'Date of entry',
                        'value'=> function($model) {
                            return date('d-m-Y',$model->updated_at);
                        }
                    ],
                    //'created_by',
                    //'updated_by',
        
                    // ['class' => 'yii\grid\ActionColumn',],
                ];
            else 
            $columns = [
                ['class' => 'yii\grid\SerialColumn'],
    
                // 'id',
                'center.center_name',
                [
                    'attribute'=> 'Patient Name',
                    'filter' => false,
                    'value' => function($model) {
                         return $model->patient_name;
                     }
                 ],
                // 'patient_age',
                // 'gender',
                // 'address:ntext',
                [
                   'attribute'=> 'template',
                   'filter' => false,
                   'value' => function($model) {
                        return $model->template_names;
                    }
                ],
                //'template_ids',
                // 'price',
            //    [ 
            //     'attribute'=> 'Price',
            //     'filter' => false,
            //     'value' => function($model) {
            //          return $model->price;
            //      }
            //  ],
             
                   
                //'created_at',
                [
                    'attribute' => 'Date of entry',
                    'value'=> function($model) {
                         return date('d-m-Y',$model->updated_at);
                     }
                 ],
                //'created_by',
                //'updated_by',
    
                // ['class' => 'yii\grid\ActionColumn',],
            ];
        ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    
   <?php echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columns,
                'columnSelectorOptions'=>[
                    'label' => 'Columns',
                    'class' => 'btn btn-success'

                ],
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Export Excel',
                    'class' => 'btn btn-primary'
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_TEXT => false,
                    //ExportMenu::FORMAT_EXCEL => false,
                ],
            ]) 
?>

 <?php if($sum) { ?>
    <div class="total">Total Price : <?php echo $sum ?></div>  
<?php } ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $columns,
    'options'=>['class'=>'grid-view'],
    // 'showFooter' => true,
]); ?>


</div>
<style>
   .grid-view table thead tr:nth-child(2) {
    display: none;
}
.total {
    margin-left: 40%;
    font-size: 1.1em;
    font-weight: bold;
}
</style>