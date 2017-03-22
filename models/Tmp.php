<?php

namespace app\models;

use Yii;
use app\models\Userdata;
/**
 * This is the model class for table "tmp".
 *
 * @property integer $UID
 * @property string $Player
 * @property string $EID
 * @property string $Awards
 * @property integer $金子
 * @property integer $金子ed
 * @property integer $Here
 */
class Tmp extends \yii\db\ActiveRecord
{
    public function getUserdata()
    {
        return $this->hasOne(Userdata::className(), ['ID' => 'UID']);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::getdb().'tmp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UID', 'Time'], 'required'],
            [['UID', 'Time'], 'integer'],
            [['EID'], 'string', 'max' => 30],
            [['Awards'], 'string', 'max' => 100],
        ];
    }

    public static function Add_attributes($attribute)
    {
        
    }
    /**
     * @inheritdoc
     */
     
    public static $arr = [
            'UID' => 'ID',
            'EID' => 'Eid',
            'Awards' => '奖项',
            'Time' => '最后活跃时间',
        ];
    public function attributeLabels()
    {
        return self::$arr;
    }
}
