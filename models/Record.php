<?php

namespace app\models;

use Yii;
use app\models\Event;
/**
 * This is the model class for table "record".
 *
 * @property integer $ID
 * @property string $Record
 * @property integer $Blur
 * @property string $Source
 * @property string $Gift
 * @property integer $Number
 * @property integer $Col
 * @property string $Manager
 * @property integer $Time
 */
class Record extends \yii\db\ActiveRecord
{
    public function PlayerName($Source, $Col)
    {
        $paragraph = Array();
        $arr = Array();
        $paragraph = explode("\n",$Source);
        foreach($paragraph as $val)
        {
            $tmp = preg_split("/[\s\t]/",$val);
            $count = count($tmp);
            $arr = array_merge($arr,$tmp);
            if($count >= $Col)
            {
                $tmp = $tmp[$Col-1];
                if(preg_match(parent::Pattern,$tmp,$match))
                $shortcut[] = $match[0];
            }
        }
        return empty($shortcut)?[]:$shortcut;
    }
    
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['RID' => 'ID']);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::getdb().'record';
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Manager', 'Record'], 'required'],
            [['Time'], 'integer'],
            [['Number'], 'double'],
            [['Gift'], 'string'],
            [['Record'], 'string', 'max' => 100],
            [['Manager'], 'string', 'max' => 20],
            [['Number'], 'compare', 'compareValue' => 0, 'operator' => '>'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Record' => '日志记录',
            'Gift' => '奖品',
            'Number' => '数量',
            'Manager' => 'Manager',
            'Time' => 'Time',
        ];
    }
}
