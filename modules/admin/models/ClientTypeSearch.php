<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClientType;

/**
 * ClientTypeSearch represents the model behind the search form about `app\models\ClientType`.
 */
class ClientTypeSearch extends ClientType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order', 'stock', 'arch_order', 'depart_eval', 'vote', 'period_vote', 'worker', 'stock_with_filter', 'rating', 'shop', 'bonus', 'stock_in_cart', 'partner_price'], 'integer'],
            [['name_uk'], 'safe'],
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
        $query = ClientType::find();

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
            'order' => $this->order,
            'stock' => $this->stock,
            'arch_order' => $this->arch_order,
            'depart_eval' => $this->depart_eval,
            'vote' => $this->vote,
            'period_vote' => $this->period_vote,
            'worker' => $this->worker,
            'stock_with_filter' => $this->stock_with_filter,
            'rating' => $this->rating,
            'shop' => $this->shop,
            'bonus' => $this->bonus,
            'stock_in_cart' => $this->stock_in_cart,
            'partner_price' => $this->partner_price,
        ]);

        $query->andFilterWhere(['like', 'name_uk', $this->name_uk]);

        return $dataProvider;
    }
}
