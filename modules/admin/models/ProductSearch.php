<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'currency_id', 'is_in_stock', 'is_new', 'is_on_sale'], 'integer'],
            [['name_uk', 'manufacturer_id', 'category_id', 'name_ru', 'description_uk', 'description_ru'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();
        $query->joinWith(['category', 'manufacturer']);

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

        $query->andFilterWhere(['like', 'product.name_uk', $this->name_uk])
            ->andFilterWhere(['like', 'category.name_uk', $this->category_id])
            ->andFilterWhere(['like', 'manufacturer.name', $this->manufacturer_id]);

        $query->orderBy('order asc');

        return $dataProvider;
    }


}
