<?php

namespace app\controllers;

use Yii;
use app\models\VehicleVariant;
use app\models\VehicleModel;
use app\models\VehicleMake;
use app\models\VehiclePrice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/**
 * VehiclePriceController implements the CRUD actions for VehiclePrice model.
 */
class VehiclePriceController extends Controller
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
        ];
    }

    /**
     * Lists all VehiclePrice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => VehiclePrice::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VehiclePrice model.
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


    public function actionModellist($id)
    {
        $countPosts = VehicleModel::find()
                ->where(['makeId' => $id])
                ->count();
 
        $posts = VehicleModel::find()
                ->where(['makeId' => $id])
                ->orderBy('model DESC')
                ->all();
 
        if($countPosts>0){
            echo "<option value = ''>Select</option>";
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->model."</option>";
            }
        }
        else{
            echo "<option value = ''>Select</option>";
        }
    }


    public function actionVariantlist($id,$cid)
    {
        $countPosts = VehicleVariant::find()
                ->where(['makeId' => $cid])
                ->andFilterWhere(['modelId' => $id])
                ->count();
 
        $posts = VehicleVariant::find()
                ->where(['makeId' => $cid])
                ->andFilterWhere(['modelId' => $id])
                ->orderBy('variant DESC')
                ->all();
 
        if($countPosts>0){
            echo "<option value = ''>Select</option>";
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->variant."</option>";
            }
        }
        else{
            echo "<option value = ''>Select</option>";
        }
    }


    public function actionShowroomprice($id)
    {
        $exShowroomPrice = VehiclePrice::findone(['variantId'=>$id]);
        
        $exShowroomValue = '';
        if($exShowroomPrice)
        {
            $exShowroomValue = $exShowroomPrice->ex_showroom_price;
        }

        return $exShowroomValue;
    }

    /**
     * Creates a new VehiclePrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
        $model = new VehiclePrice();
        $cmodel = VehicleMake::find()->all();
        

        if ($model->load(Yii::$app->request->post()) && $model->save())
         {
            return $this->redirect(['view', 'id' => $model->id]);
            // print_r($model->getErrors());
            // print_r($model);
            // die('test');
           
        }

        return $this->render('create', [
            'model' => $model,
            'cmodel' => $cmodel,

        ]);
    }

    /**
     * Updates an existing VehiclePrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        $cmodel = VehicleMake::find()->all();


        $vmodel = VehicleModel::find()
                ->where(['makeId' => $model->makeId])
                ->orderBy('model')
                ->all();

        $exmodel = VehicleVariant::find()
                ->where(['modelId' => $model->modelId])
                ->orderBy('variant')
                ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cmodel' => $cmodel,
            'vmodel' => $vmodel,
            'exmodel' => $exmodel,
        ]);
    }


    /**
     * Deletes an existing VehiclePrice model.
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
     * Finds the VehiclePrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VehiclePrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VehiclePrice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
