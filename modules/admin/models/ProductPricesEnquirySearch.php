<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductPricesEnquiry;

/**
 * ProductPricesEnquirySearch represents the model behind the search form about `app\models\ProductPricesEnquiry`.
 */
class ProductPricesEnquirySearch extends ProductPricesEnquiry
{


    public $product_name;
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'user_id'], 'integer'],
            [['name', 'email', 'product_name', 'user_name', 'phone', 'asked_at'], 'safe'],
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
        $query = ProductPricesEnquiry::find();
        $query->joinWith(['user', 'product']);

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
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'asked_at' => $this->asked_at,
        ]);

        $query->andFilterWhere(['like', 'product.name_uk', $this->product_name])
            ->andFilterWhere(['like', 'user.login', $this->user_name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
