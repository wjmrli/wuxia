<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "Gift".
 *
 * @property integer $ID
 * @property string $Realname
 */
class Gift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::getdb().'Gift';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Realname'], 'string', 'max' => 20],
            [['Realname'], 'unique', 'message'=>'奖品已存在'],
            [['Realname'], 'match', 'not' => true, 'pattern' => "(;)", 'message' => '包含不合法字符'],
            [['Number'], 'integer'],
            [['Number'], 'number', 'min'=>1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Realname' => 'Realname',
            'Number' => '每周上限数量',
        ];
    }
}
