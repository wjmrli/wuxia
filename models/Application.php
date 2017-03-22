<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $ID
 * @property string $Username
 * @property integer $Time
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::getdb().'.application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Time'], 'integer'],
            [['Username'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Username' => 'Username',
            'Time' => 'Time',
        ];
    }
}
