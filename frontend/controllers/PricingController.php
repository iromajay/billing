<?php

namespace frontend\controllers;

use Yii;
use app\models\Pricing;
use app\models\PricingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * PricingController implements the CRUD actions for Pricing model.
 */
class PricingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','delete','view'],
                        'roles' => ['Admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Pricing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PricingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pricing model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pricing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pricing();

        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
            $this->saveCategory($model,'CT-type-1',$model->center_id,$model->ctType1Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-2',$model->center_id,$model->ctType2Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-3',$model->center_id,$model->ctType3Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-4',$model->center_id,$model->ctType4Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-5',$model->center_id,$model->ctType5Price,$model->franchise_id);

            $this->saveCategory($model,'MRI-type-1',$model->center_id,$model->MRI1Price,$model->franchise_id);
            $this->saveCategory($model,'MRI-type-2',$model->center_id,$model->MRI2Price,$model->franchise_id);
            $this->saveCategory($model,'MRI-type-3',$model->center_id,$model->MRI3Price,$model->franchise_id);
            
            $this->saveCategory($model,'XRAY-type-1',$model->center_id,$model->XRAY1Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-2',$model->center_id,$model->XRAY2Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-3',$model->center_id,$model->XRAY3Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-4',$model->center_id,$model->XRAY4Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-5',$model->center_id,$model->XRAY5Price,$model->franchise_id);
            $transaction->commit();
            // die;
            Yii::$app->session->setFlash("success","Pricing added succesfully");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function saveCategory($model,$category,$center_id,$price,$franchise_id){
        $newModel = new Pricing();
        // $newModel = $model;
        $existModel = Pricing::find()->where(['category'=>$category,'center_id'=>$center_id,'franchise_id'=>$franchise_id])->one();
        if($existModel) {
            $existModel->category = $category;
            $existModel->price = $price;
            $existModel->center_id = $center_id;
            $existModel->franchise_id = $center_id;
            if(!$existModel->save(false)){
                print_r($model->errors);die;
            }
            return;
        }
        else {
            $newModel->category = $category;
            $newModel->price = $price;
            $newModel->center_id = $center_id;
            $newModel->franchise_id = $franchise_id;
        }
        // echo "1";
        if(!$newModel->save(false)){
            print_r($model->errors);die;
        }
    }

    /**
     * Updates an existing Pricing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            // echo $model->center_id;die;
            $transaction = Yii::$app->db->beginTransaction();
            try{
            $this->saveCategory($model,'CT-type-1',$model->center_id,$model->ctType1Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-2',$model->center_id,$model->ctType2Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-3',$model->center_id,$model->ctType3Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-4',$model->center_id,$model->ctType4Price,$model->franchise_id);
            $this->saveCategory($model,'CT-type-5',$model->center_id,$model->ctType5Price,$model->franchise_id);

            $this->saveCategory($model,'MRI-type-1',$model->center_id,$model->MRI1Price,$model->franchise_id);
            $this->saveCategory($model,'MRI-type-2',$model->center_id,$model->MRI2Price,$model->franchise_id);
            $this->saveCategory($model,'MRI-type-3',$model->center_id,$model->MRI3Price,$model->franchise_id);
            
            $this->saveCategory($model,'XRAY-type-1',$model->center_id,$model->XRAY1Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-2',$model->center_id,$model->XRAY2Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-3',$model->center_id,$model->XRAY3Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-4',$model->center_id,$model->XRAY4Price,$model->franchise_id);
            $this->saveCategory($model,'XRAY-type-5',$model->center_id,$model->XRAY5Price,$model->franchise_id);
            }
            catch (\Throwable $e) {
                $transaction->rollBack();
            }
            $transaction->commit();
            // die;
            Yii::$app->session->setFlash("success","Pricing added succesfully");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pricing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pricing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pricing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pricing::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
