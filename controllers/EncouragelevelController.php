<?php

namespace app\controllers;

use Yii;
use app\models\Encouragelevel;
use app\models\EncouragelevelSearch;
use app\models\Gift;
use app\models\GiftSearch;
use app\models\Userdata;
use app\models\Tmp;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * EncouragelevelController implements the CRUD actions for Encouragelevel model.
 */
class EncouragelevelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete','level','add','del','gift'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','add','gift','level'],
                        'allow' => true,
                        'roles' => ['m'],
                    ],
                    [
                        'actions' => ['delete','del','index','view','create','update','add','gift','level'],
                        'allow' => true,
                        'roles' => ['owner'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                    'del' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Encouragelevel models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Lists all Encouragelevel models.
     * @return mixed
     */
    public function actionGift()
    {
        $searchModel = new GiftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('gift', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Add a new Encouragelevel gift model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Gift();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Userdata::AddColumn($model->Realname,'float(5) not null default 0');
            Tmp::AddColumn($model->Realname,'float(5) not null default 0');
            Tmp::AddColumn($model->Realname."ed",'float(5) not null default 0');
            return $this->redirect(['gift']);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Deletes an existing Encouragelevel gift model.
     * If deletion is successful, the browser will be redirected to the 'gift' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id)
    {
        Gift::deleteAll('ID = '.$id);
        if (Yii::$app->getRequest()->isAjax) {
            return "delLine(component)";
        }
        return $this->redirect(['gift']);
    }
    
    /**
     * Lists all Encouragelevel models.
     * @return mixed
     */
    public function actionLevel()
    {
        $searchModel = new EncouragelevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchgift = new GiftSearch();
        $sql = "select Realname from ".Yii::getdb()."gift";
        $gift = $searchgift->findBySql($sql)->All();
        $gift = ArrayHelper::getColumn($gift,'Realname');
        foreach($gift as $val)
        {
            $tmp[$val]=$val;
        }
        if(empty($tmp)){
            return $this->render('level', [
                'dataProvider' => $dataProvider,
                'createable' => 'disable',
            ]);
        }else{
            return $this->render('level', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    
    /**
     * Displays a single Encouragelevel model.
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
     * Creates a new Encouragelevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Encouragelevel();
        
        //$gift = ArrayHelper::index($tmp,'Realname');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['level']);
        } else {
            $searchgift = new GiftSearch();
            $sql = "select Realname from ".Yii::getdb()."gift";
            $gift = $searchgift->findBySql($sql)->All();
            $gift = ArrayHelper::getColumn($gift,'Realname');
            foreach($gift as $val)
            {
                $tmp[$val]=$val;
            }
            if(!empty($tmp)){
                return $this->render('create', [
                    'model' => $model,
                    'gift' => $tmp,
                ]);
            }else{
                return $this->redirect(['add']);
            }
        }
    }

    /**
     * Updates an existing Encouragelevel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchgift = new GiftSearch();
        $sql = "select Realname from ".Yii::getdb()."gift";
        $gift = $searchgift->findBySql($sql)->All();
        $gift = ArrayHelper::getColumn($gift,'Realname');
        foreach($gift as $val)
        {
            $tmp[$val]=$val;
        }
        $gift = $tmp;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'gift' => $gift,
            ]);
        }
    }

    /**
     * Deletes an existing Encouragelevel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if (Yii::$app->getRequest()->isAjax) {
            return "delLine(component)";
        } 
        return $this->redirect(['level']);
    }

    /**
     * Finds the Encouragelevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Encouragelevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encouragelevel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
