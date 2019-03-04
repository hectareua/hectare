<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DepartmentRating;

/**
 * DepartmentRatingSearch represents the model behind the search form about `app\models\DepartmentRating`.
 */
class DepartmentRatingSearch extends DepartmentRating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'mark'], 'integer'],
            [['date_add','user_id', 'depart_id'], 'safe'],
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
        $query = DepartmentRating::find();
        $query->joinWith(['depart', 'user', 'client']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'mark' => $this->mark,
            'date_add' => $this->date_add,
        ])
        ->andFilterWhere(['like', 'department.name_uk',$this->depart_id])
        ->andFilterWhere(['like', 'client.billing_last_name',$this->user_id]);

        return $dataProvider;
    }
}
