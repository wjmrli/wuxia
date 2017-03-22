<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fuwuqi".
 *
 * @property integer $ID
 * @property integer $DID
 * @property string $Fuwuqi
 */
class Fuwuqi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outline.fuwuqi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DID'], 'integer'],
            [['Fuwuqi'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DID' => 'Did',
            'Fuwuqi' => 'Fuwuqi',
        ];
    }
}
