<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $amount
 * @property integer $discount
 *
 *
 * @property Product $product
 * @property Order $order
 * @property OrderProductAttributeValue[] $orderProductAttributeValues
 */
class OrderProductSearch extends OrderProduct
{

    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */
    public $status;
    public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'amount'], 'integer'],
            [['discount'], 'number'],
            [['date_from', 'date_to'], 'safe'],

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
        $user = Yii::$app->user->identity->id;
        $query = OrderProduct::find()
            ->joinWith(['order o' => function($o) {
            $o->joinWith(['client c' => function($c) {
                    $c->joinWith('user u');}]);}])
            ->where(['u.id' => $user])
            ->orderBy('o.id DESC');

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
       // var_dump($params); die();
        // grid filtering conditions

        if($params['status'] == 7){
            $query->andFilterWhere(['=', 'o.status_id', $params['status']])
            ->andFilterWhere(['>=', 'o.ordered_at', $this->date_from])
            ->andFilterWhere(['<=', 'o.ordered_at', $this->date_to]);
        }else{

            $query->andFilterWhere(['<>', 'o.status_id', '7']);
        }
        //$query->andFilterWhere([ 'amount' => $this->amount]);


//           // ->andFilterWhere(['=', 'order_id', $this->order_id])
//            ->andFilterWhere(['=', 'order_id', $this->phone])
//            ->andFilterWhere(['=', 'amount', $this->amount]);

        return $dataProvider;

    }



}
