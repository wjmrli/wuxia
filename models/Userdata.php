<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Tmp;
/**
 * This is the model class for table "userdata".
 *
 * @property integer $ID
 * @property integer $Time
 * @property string $Player
 * @property integer $Here
 */
class Userdata extends \yii\db\ActiveRecord
{
    /**
     * @author $player为数组
     * @author $param [0为激活,1为注销,2为暂存]
     * @author return：$param==2返回所有$player_ID对应的userdata.ID
     * */
    public static function operate($player_name,$params = [])
    {
        $time = time();
        $param = isset($params['param'])?$params['param']:'0';
        $blur = isset($params['blur'])?$params['blur']:'0';
        $sql = "select Player,Here from ".self::tableName();
        $userdata = self::findBySql($sql)->indexBy('Player')->All();
        $Here = ArrayHelper::getColumn($userdata,'Here');
        $str = "共处理 ".count($player_name)." 个信息：\n";
        $cname = [];
        $insert = '';
        foreach($player_name as $val)
        {
            $exist = ArrayHelper::getValue($Here,$val);
            //$error[] = $exist;
            if($exist == 1)//游戏ID状态为已注销
            {
                if($param == '0')
                {
                    $sql = "UPDATE ".self::tableName()." SET  `Here` =  '0', `Time` = '$time' WHERE  ".self::tableName().".`Player` ='$val'";
                    $effectRows = Yii::$app->db->createCommand($sql)->execute();
                    if($effectRows == '1')
                    if(isset($middle))$middle .= $val." => 激活成功\n";
                    else $middle = $val." => 激活成功\n";
                }
                else if($param == '1')
                {
                    if(isset($foot))$foot .= $val." => 已被注销\n";
                    else $foot = $val." => 已被注销\n";
                }
                $cname[$val] = $exist;
            }
            else if($exist == '0')//游戏ID状态为已激活
            {
                if($param == '0')
                {
                    if(isset($foot))$foot .= $val." => 已存在\n";
                    else $foot = $val." => 已存在\n";
                }
                else if($param == '1')
                {
                    $sql = "UPDATE ".self::tableName()." SET  `Here` =  '1', `Time` = '$time' WHERE  ".self::tableName().".`Player` ='$val'";
                    $effectRows = Yii::$app->db->createCommand($sql)->execute();
                    if($effectRows == '1')
                    if(isset($head))$head .= $val." => 注销成功\n";
                    else $head = $val." => 注销成功\n";
                }
                $cname[$val] = $exist;
            }
            else if($exist == '2')
            {
                if($param == '0')
                {
                    $sql = "UPDATE ".self::tableName()." SET  `Here` =  '0' WHERE  ".self::tableName().".`Player` ='$val'";
                    $effectRows = Yii::$app->db->createCommand($sql)->execute();
                    if($effectRows == '1')
                    if(isset($middle))$middle .= $val." => 激活成功\n";
                    else $middle = $val." => 激活成功\n";
                }
                else if($param == '1')
                {
                    $sql = "UPDATE ".self::tableName()." SET  `Here` =  '1', `Time` = '$time' WHERE  ".self::tableName().".`Player` ='$val'";
                    $effectRows = Yii::$app->db->createCommand($sql)->execute();
                    if($effectRows == '1')
                    if(isset($head))$head .= $val." => 注销成功\n";
                    else $head = $val." => 注销成功\n";
                }
                $cname[$val] = $exist;
            }
            else
            {
                $mark = 0;
                if(isset($player))
                foreach($player as $name)
                {
                    if($val == $name)
                    {$mark = 1;break;}
                }
                if($mark == 1)continue;
                $player[] = $val;
                $insert .= "('$time','$val','$param'),";
                if($param == '0')
                {
                    if(isset($tmp))$tmp .= $val." => 注册成功\n";
                    else $tmp = $val." => 注册成功\n";
                }
                else if($param == '1')
                {
                    if(isset($tmp))$tmp .= $val." => 注销成功\n";
                    else $tmp = $val." => 注销成功\n";
                }
            }
        }
        if(isset($player)&&$blur == '0'&&!empty($insert))
        {
            $sql = "INSERT INTO ".self::tableName()."(Time, Player, Here) Values ".substr($insert,0,-1);
            $effectRows = Yii::$app->db->createCommand($sql)->execute();
            if($effectRows == count($player))
            {
                if($param == '0')
                {
                    $head = $tmp;
                }
                else if($param == '1')
                {
                    if(isset($head))$head .= $tmp;
                    else $head = $tmp;
                }
            }
        }
        if($param == '2')
        {
            $ID = [];
            $ID_State = [];
            $dereg = [];
            $ID_All = ArrayHelper::getColumn(Userdata::find()->indexBy('Player')->All(),'ID');
            if(!empty($ID_All))
            {
                foreach($cname as $key => $val)
                {
                    $ID[] = $ID_All[$key];
                    $ID_State[] = $val;
                    if($val == '1')
                    $dereg[] = $key;
                    else $reg_and_tmp[] = $key;
                }
                if($blur == '0'&&isset($player)){
                    foreach($player as $val)
                    {
                        $ID[] = $ID_All[$val];
                        $ID_State[] = '';
                        $reg_and_tmp[] = $val;
                    }
                }
            }
            
            return ['ID' => $ID, 'ID_State' => $ID_State, 'extra_name' => isset($player)? $player:[], 'inner_name' => array_keys($cname), 'dereg_name' => $dereg, 'reg_and_tmp' => isset($reg_and_tmp)? $reg_and_tmp:[]];
        }
        else
        {
            $rep = "";
            if(isset($head))$rep.=$head;
            if(isset($middle))$rep.=$middle;
            if(isset($foot))$rep.=$foot;
            return $str.$rep;
        }
        
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::getdb().'userdata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Time', 'Here'], 'integer'],
            [['Player'], 'string', 'max' => 20],
            [['Player'], 'unique', 'message' => '该游戏ID已存在'],
            [['Here'], 'in', 'range' => [0, 1, 2]],
            [['Player'], 'match', 'pattern' => parent::Pattern, 'message'=> '游戏ID不规范'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Time' => '最后活跃时间',
            'Player' => '游戏ID',
            'Here' => 'Here',
        ];
    }
}
