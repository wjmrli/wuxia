<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tmp;

/**
 * TmpSearch represents the model behind the search form about `app\models\Tmp`.
 */
class TmpSearch extends Tmp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UID'], 'integer'],
            [['EID', 'Awards'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tmp::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['Here'=>SORT_ASC]),
            'Pagination' => [
                'pageSize' => 200,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'UID' => $this->UID,
        ]);

        $query->andFilterWhere(['like', 'EID', $this->EID])
            ->andFilterWhere(['like', 'Awards', $this->Awards]);

        return $dataProvider;
    }
}
