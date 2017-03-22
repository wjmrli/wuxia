<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Encourage;
use app\models\EncourageSearch;
use app\models\Userdata;
use app\models\UserdataSearch;
use app\models\Gift;
use app\models\Tmp;
use app\models\TmpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\GiftSearch;
use yii\helpers\ArrayHelper;
use app\models\Record;
use app\models\Event;
use app\models\RecordSearch;
/**
 * EncourageController implements the CRUD actions for Encourage model.
 */
class EncourageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','inload','delete','del','done','record','recorddel'],
                'rules' => [
                    [
                        'actions' => ['inload','record'],
                        'allow' => true,
                        'roles' => ['m'],
                    ],
                    [
                        'actions' => ['index','view','delete','del','done','recorddel','inload','record'],
                        'allow' => true,
                        'roles' => ['owner'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'done' => ['GET'],
                    'del' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Encourage models.
     * @return mixed
     */
    public function actionIndex($choose = '',$Timestamp = [])
    {
            $last = Record::find()->orderBy('Time desc')->one();
            //ArrayHelper::getColumn(Record::findBySql("SELECT Time from ".Encourage::tableName()." order by Time desc limit 1")->All(),'Time');
            //$max_time = Tmp::find()->max('Time');
            //if(!empty($max_time))
            if(!empty($last))
            if((isset($_SESSION['last'])&&$_SESSION['last']<=$last->Time)||!isset($_SESSION['last']))
            {
                $params = [];
                if(!empty($Timestamp)){
                    $params = ['Timestamp' => $Timestamp];
                    $_SESSION['Timestamp'] = $Timestamp;
                }
                $info = Encourage::read($params);
                if(!empty($info))//数据非空
                {
                    Yii::$app->db->createCommand()->truncateTable(Tmp::tableName())->execute();
                    foreach($info as $key => $val)
                    {
                        $EID = "";
                        $model = Tmp::findOne($key);
                        if($model === null)
                        {
                            $model = new Tmp();
                            $model->UID = $key;
                        }
                        $model->Awards = $val['Record'];
                        foreach($val['Gifts'] as $name => $number)
                        eval("\$model->".$name." = \"$number\";");
                        foreach($val['Done'] as $name => $number)
                        eval("\$model->".$name."ed = \"$number\";");
                        unset($val['Gifts'],$val['Done'],$val['Record'],$val['Here']);
                        foreach($val as $keypart => $value)
                        $EID .= $keypart.',';
                        $model->EID = substr($EID,0,-1);
                        $model->Time = time();
                        $model->save();
                    }
                    
                }
                $_SESSION['last'] = time();
            }
        
        $chooses = Encourage::$gift;
        if($chooses == null){
            if(isset($_SESSION['chooses']))$chooses = $_SESSION['chooses'];
        }
        else $_SESSION['chooses'] = $chooses;
        $searchModel = new TmpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith('userdata');
        if(!empty($choose)){
            $_SESSION['choose']=$choose;
        }elseif(isset($_SESSION['choose']))$choose = $_SESSION['choose'];
        if(!empty($choose)){//需检查是否存在该字段
            
            $_SESSION['limit'] = Gift::find()->indexBy('Realname')->all()[$choose]->Number;
            
            $split = explode(".",Tmp::tableName());
            $tablename = '`'.$split[0].'`.`'.$split[1].'`';
            
            $split = explode(".",Userdata::tableName());
            $tablename2 = '`'.$split[0].'`.`'.$split[1].'`';
            
            $dataProvider->query->where = ['>',Tmp::tableName().'.'.$choose,0];
            $dataProvider->query->andFilterWhere(['<>', $tablename2.'.`Here`',1]);
            $chose = $choose."ed";
            $paragraph = '('.$_SESSION['limit'].'-'.$tablename.'.`'.$chose.'`-'.$tablename.'.`'.$choose.'`)';
            $dataProvider->query->orderBy($tablename2.'.`Here` asc , case when '.$paragraph.'>0 then '.$tablename.'.`'.$choose.'` else ('.$_SESSION['limit'].' - '.$tablename.'.`'.$chose.'`) end desc');
        }
        
        //$choose = '金子';
        return $this->render('index_tmp', [
            //'searchModel' => $searchModel,
            'chooses' => $chooses,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Encourage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $arr = $model->attributes;
        //die(var_dump($model->userdata->attributes));
        $arr['Here'] = $model->userdata->attributes['Here'];
        $base['ID'] = $id;
        $base['游戏ID'] = $model->userdata->attributes['Player'];
        unset($arr['EID'],$arr['UID']);
        if($arr['Here'] ===2){
            $base['角色状态'] = '未激活';
        }elseif($arr['Here']===0){
            $base['角色状态']='已存在';
        }elseif($arr['Here']===1){
            $base['角色状态']='已注销';
        }
        $base['最后活跃时间']=date('Y-m-d',$arr['Time']);
        unset($arr['Here'],$arr['Time']);
        
        foreach($arr as $key => $val)
        {
            if($val == null){
                unset($arr[$key]);
                continue;
            }
            if(key_exists($key,Tmp::$arr))
            {
                $base[Tmp::$arr[$key]] = $val;
                unset($arr[$key]);
            }
            if(substr($key,strlen($key)-2,2)=='ed'){
                $arr['本周已发'.substr($key,0,strlen($key)-2)] = $val;
                unset($arr[$key]);
            }
        }
        return $this->render('view_tmp', [
            'base' => $base,
            'gift' => $arr,
        ]);
    }

    /**
     * Creates a new Encourage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Tmp();
        $searchgift = new GiftSearch();
        $sql = "select Realname from ".Yii::getdb()."gift";
        $gift = $searchgift->findBySql($sql)->All();
        $gift = ArrayHelper::getColumn($gift,'Realname');
        $tmp = [];
        foreach($gift as $val)
        {
            $tmp[$val]=$val;
        }
        $gift = $tmp;
        //$gift = ArrayHelper::index($gift,'Realname');
        if ($model->load(Yii::$app->request->post())&&$model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'gift' => $gift,
            ]);
        }
    }*/

    /**
     * Creates a new Encourage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionInload()
    {
        $model = new Record();
        $event = new Event();
        $model->Time = time();
        $model->Manager = Yii::$app->user->IDentity->username;
        $model->Origin = 'inload';
        if ($model->load(Yii::$app->request->post()) && $event->load(Yii::$app->request->post())) {        
            $player_name =  $model->PlayerName($event->Source,$event->Col);
            if($model->Gift == '批量激活'){
                $model->Origin = 'reg';
                $model->save();
                $record_ID = $model->ID;
                $error = Userdata::operate($player_name,['param' =>'0']);
            }elseif($model->Gift == '批量注销'){
                $model->Origin = 'dereg';
                $model->save();
                $record_ID = $model->ID;
                $error = Userdata::operate($player_name,['param' => '1']);
            }else{
                $model->save();
                $record_ID = $model->ID;
                if($event->Blur == '0')
                {
                    $userdata_rep = Userdata::operate($player_name,['param' => '2']);
                    $player_ID = $userdata_rep['ID'];
                    $ID_State = $userdata_rep['ID_State'];
                    $reg_and_tmp = $userdata_rep['reg_and_tmp'];
                    $params = [
                        'player_ID' => $player_ID,
                        'ID_State' => $ID_State,
                        'record_ID' => $record_ID,
                        'reg_and_tmp' => $reg_and_tmp,
                    ];
                    $ins_rep = Encourage::operate($params);
                }
                else
                {
                    $userdata_rep = Userdata::operate($player_name,['param' => '2', 'blur' => '1']);
                    $player_ID = $userdata_rep['ID'];
                    $ID_State = $userdata_rep['ID_State'];
                    $reg_and_tmp = $userdata_rep['reg_and_tmp'];
                    $params = [
                        'player_ID' => $player_ID,
                        'ID_State' => $ID_State,
                        'record_ID' => $record_ID,
                        'reg_and_tmp' => $reg_and_tmp,
                    ];
                    $ins_rep = Encourage::operate($params);
                    $extra_name = $userdata_rep['extra_name'];
                    $inner_name = $userdata_rep['inner_name'];
                    $blur_rep = Encourage::deal_blur($extra_name, $inner_name);
                }
                $dereg_name = $userdata_rep['dereg_name'];
                foreach($dereg_name as $val)
                {
                    if(!isset($dereg_rep))$dereg_rep = $val." 已被注销\n";
                    else $dereg_rep.= $val." 已被注销\n";
                }
                $error = '';
                if(isset($blur_rep))$error .= $blur_rep;
                if(isset($dereg_rep))$error .= $dereg_rep;
                if(isset($ins_rep))$error .= $ins_rep;
            }
            $event->Result = $error;
            $event->RID = $record_ID;
            $event->save();
            $event = new Event();
            if(isset($blur_rep)){
                $event->Source = $blur_rep;
                $event->Col = 1;
            }else return $this->redirect(['record','id'=>$record_ID]);
        } 
        
        {
            //$record = [];
            $record = Record::find()->where(['Origin'=>'inload'])->orWhere(['Origin'=>'reg'])->orWhere(['Origin'=>'dereg'])->joinWith('event')->indexBy('ID')->select(['Record','Time','ID','Result'])->orderBy('ID desc')->all();
            /*if(!empty($recordsearch)){
                $col_record = ArrayHelper::getColumn($recordsearch,'Record');
                $col_time = ArrayHelper::getColumn($recordsearch,'Time');
                foreach($col_record as $key => $val)
                {
                    //$record .= $val.'  ('.date('m-d H:i',$col_time[$key]).')'."\r\n";
                    $record[$key] = $val.'  ('.date('m-d H:i',$col_time[$key]).')';
                }
            }*/
            $gift = Gift::find()->all();
            $gift = ArrayHelper::getColumn($gift,'Realname');
            $tmp = [];
            foreach($gift as $val)
            {
                $tmp[$val]=$val;
            }
            $gift = $tmp;
            $gift['批量激活'] = '批量激活';
            $gift['批量注销'] = '批量注销';
            return $this->render('inload', [
                'model' => $model,
                'event' => $event,
                'gift' => $gift,
                'record' => $record,
            ]);
        }
    }

    /**
     * Deletes an existing Encourage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = Userdata::findOne($id);
        Userdata::operate([$model->Player],['param'=>1]);
        Encourage::deleteAll(['UID' => $id]);
        if (Yii::$app->getRequest()->isAjax) {
            return "delLine(component)";
        }
        return $this->redirect(['index']);
    } 
    
    public function actionDel($id)
    {
        $model = Userdata::findOne($id);
        Userdata::operate([$model->Player],['param'=>1]);
        Encourage::deleteAll(['UID' => $id]);
        if (Yii::$app->getRequest()->isAjax) {
            return "delLine(component)";
        }
        return $this->redirect(['index']);
    } 
    
    public function actionDone($id)
    {
        if(!isset($_SESSION['choose']))return $this->redirect(['index']);
        $gift = $_SESSION['choose'];
        if(isset($_SESSION['Timestamp']))
        $params['Timestamp'] = $_SESSION['Timestamp'];
        $params['UID'] = [$id];
        $info = Encourage::read($params)[$id];
        unset($info['Record'],$info['Here']);
        $delete = "";
        foreach($info as $key => $val){
            if($val == $gift)
                $delete .= "ID=".$key." or ";
        }
        //die($delete);
        if(!empty($delete))
        {
            $number = $info['Gifts'][$gift];
            $limit = ArrayHelper::getColumn(Gift::find()->where(['Realname'=>$gift])->all(),'Number')[0];
            //判断本周是否溢出
            $rest = $number - $limit;
            if(isset($info['Done'][$gift]))//存在已发放奖励，则调整余量
                $rest += $info['Done'][$gift];
            if(!isset($info['Done'][$gift])||($info['Done'][$gift] < $limit)){
            if($rest > 0){
                //保存溢出数据
                $model = new Record();
                $model->Record = '上周剩余';
                $model->Gift = $gift;
                $model->Number = $rest;
                $model->Manager = Yii::$app->user->IDentity->username;
                $model->Time = time();
                $model->Origin = 'rest';
                if (!$model->save()) {
                    return "alert('record 1')";
                }
                $record_ID = $model->ID;
                if(isset($info['Done'][$gift]))$number = $limit - $info['Done'][$gift];
                else $number = $limit;
                //新建记录
                $model = new Encourage();
                $model->UID = $id;
                $model->EID = $record_ID;
                $model->Time = time();
                if (!$model->save()) {
                    return "alert('encourage 1')";
                }
            }else {
                $rest = 0;
            }
            //新建事件
            $model = new Record();
            $model->Record = '1';
            $model->Gift = $gift;
            $model->Number = $number;
            $model->Manager = Yii::$app->user->IDentity->username;
            $model->Time = time();
            $model->Origin = 'done';
            if (!$model->save()) {
                return "alert('record 2')";
            }
            //获取事件EID
            $record_ID = $model->ID;
            //新建记录
            $model = new Encourage();
            $model->UID = $id;
            $model->EID = $record_ID;
            $model->Time = time();
            if (!$model->save()) {
                return "alert('encourage 2')";
            }
            //删除或修改旧记录
            if($rest > 0)
            $this->findModel($id)->update(['Here' => 3]);
            Encourage::deleteAll(substr($delete,0,-3));
            $model = Userdata::findOne($id);
            $model->Here = 0;
            $model->update();
            
            }
        }
        if (Yii::$app->getRequest()->isAjax) {
            if($rest != 0)
            return "reset_giftnumber(".$rest.",component)";
            else return "delLine(component)";
        }
        else return $this->redirect(['index']);
    }

    public function actionRecord($id)
    {
        $event = Event::find()->joinWith('r')->where(['RID'=>$id])->one();
        //return var_dump($event);
        return $this->render('record',[
            'model' => $event,
        ]);
        
    }
    
    public function actionRecorddel($id)
    {
        $model = Record::findOne($id);
        $model->Time = time();
        $model->Origin = 'abandon';
        $model->save();
        Event::find()->where(['RID'=>$id])->one()->delete();
        Encourage::deleteAll(['EID'=>$id]);
        
        return $this->redirect(['inload']);
    }
    /**
     * Finds the Encourage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Encourage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tmp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
