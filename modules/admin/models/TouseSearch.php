<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Touse;

/**
 * ManagerSearch represents the model behind the search form about `app\models\Manager`.
 */
class TouseSearch extends Touse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','phase_id','problem_id','product_id', 'plant_id', 'sector_id'], 'integer'], 
            [['product_id'], 'safe'],           
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
        $query = Touse::find();
        $query->joinWith(['plants', 'phases', 'problems', 'product']);        

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
            'plant_id' => $this->plant_id,
            'phase_id' => $this->phase_id,
            'problem_id' => $this->problem_id,
            'product_id' => $this->product_id,       
            'sector_id' => $this->sector_id,       
        ]);

        $query->andFilterWhere(['like', 'plant_id', $this->plant_id])
            ->andFilterWhere(['like', 'phase_id', $this->phase_id])
        //    ->andFilterWhere(['like', 'problem_id', $this->problem_id])
            ->andFilterWhere(['like', 'problems.name', $this->problem_id])
            ->andFilterWhere(['like', 'product.name_uk', $this->product_id]);

        return $dataProvider;
    }
}
