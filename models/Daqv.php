<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "daqv".
 *
 * @property integer $ID
 * @property string $Daqv
 */
class Daqv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outline.daqv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Daqv'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Daqv' => 'Daqv',
        ];
    }
}
