<?php

namespace app\modules\admin\models;

use app\models\Manager;
use app\models\ManagerTrophy;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ManagerTrophyRelation;

/**
 * ManagerTrophyRelationSearch represents the model behind the search form about `app\models\ManagerTrophyRelation`.
 */
class ManagerTrophyRelationSearch extends ManagerTrophyRelation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id', 'manager_id', 'manager_trophy_id'], 'safe'],

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
        $query = ManagerTrophyRelation::find();
        $query->joinWith(['manager', 'managerTrophy']);

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
        $query->andFilterWhere(['like', 'manager.name', $this->manager_id])
              ->andFilterWhere(['like', 'manager_trophy.desc_uk', $this->manager_trophy_id]);

        return $dataProvider;
    }
}
