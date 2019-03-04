<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'payment_system_id', 'status_id', 'delivery_country_id'], 'integer'],
            [['ordered_at', 'billing_fullname', 'billing_city', 'billing_region', 'billing_phone', 'billing_email', 'delivery_fullname', 'delivery_address', 'delivery_city', 'delivery_region', 'delivery_phone', 'comment'], 'safe'],
            [['is_one_c_order'], 'boolean']
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
        $query = Order::find()->orderBy('id DESC');

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
            'client_id' => $this->client_id,
            'payment_system_id' => $this->payment_system_id,
            'status_id' => $this->status_id,
            'ordered_at' => $this->ordered_at,
            'delivery_country_id' => $this->delivery_country_id,
             'is_one_c_order' => $this->is_one_c_order
        ]);

        $query->andFilterWhere(['like', 'billing_fullname', $this->billing_fullname])
            ->andFilterWhere(['like', 'billing_city', $this->billing_city])
            ->andFilterWhere(['like', 'billing_region', $this->billing_region])
            ->andFilterWhere(['like', 'billing_phone', $this->billing_phone])
            ->andFilterWhere(['like', 'billing_email', $this->billing_email])
            ->andFilterWhere(['like', 'delivery_fullname', $this->delivery_fullname])
            ->andFilterWhere(['like', 'delivery_address', $this->delivery_address])
            ->andFilterWhere(['like', 'delivery_city', $this->delivery_city])
            ->andFilterWhere(['like', 'delivery_region', $this->delivery_region])
            ->andFilterWhere(['like', 'delivery_phone', $this->delivery_phone])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
