<?php

namespace app\controllers;

use Yii;
use app\models\Userdata;
use app\models\UserdataSearch;
use app\models\Encourage;
use app\models\Record;
use app\models\Tmp;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * UserdataController implements the CRUD actions for Userdata model.
 */
class UserdataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete','valid'],
                'rules' => [
                    [
                        'actions' => ['index','update','delete','valid'],
                        'allow' => true,
                        'roles' => ['m'],
                    ],
                    [
                        'actions' => ['index','update','delete','valid'],
                        'allow' => true,
                        'roles' => ['owner'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'update' => ['GET'],
                    'del' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Userdata models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserdataSearch();
        $sql = "select * from ".Yii::getdb()."userdata where Here=0";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$sql);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Userdata model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Userdata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Userdata();
        $model->Time = time();
        $model->Here = 0;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->Player = '';
            return $this->render('create',[
                'model' => $model,
                'msg' => '激活成功',
            ]);
        } else {
            return $this->render('create', [
                
                'model' => $model,
                
            ]);
        }
    }*/

    public function actionValid()
    {
        $searchModel = new UserdataSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams,"select Player,Time,ID from ".Yii::getdb()."userdata where Here=2");
        $searchModel->Here = 2;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('valid', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    /**
     * Updates an existing Userdata model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$confirm = '')
    {
        $model = $this->findModel($id);
        if(empty($confirm)){
            $history = Encourage::findAll(['UID' => $id]);
            if(!empty($history))return "reg_confirm(i,url)";
        }
        Userdata::operate([$model->Player],['param'=>0]);
        if($confirm == 'no'){
            Encourage::deleteAll(['UID' => $id]);
            Tmp::findOne($id)->delete();
        }
        return "delLine(component)";
    }
    
    public function actionDel($id)
    {
        $model = $this->findModel($id);
        Userdata::operate([$model->Player],['param'=>1]);
        Encourage::deleteAll(['UID' => $id]);
        
        if (Yii::$app->getRequest()->isAjax) {
            return "delLine(component)";
        }
        else return $this->redirect(['valid']);
    }
    /**
     * Deletes an existing Userdata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*$model = $this->findModel($id);
        $model->Here = 1;
        $model->save();*/
        Userdata::operate([$id],['param'=>'1']);
        //return 
        return $this->redirect(['index']);
    }

    /**
     * Finds the Userdata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Userdata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userdata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
