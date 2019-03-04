<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserReview;

/**
 * UserReviewSearch represents the model behind the search form about `app\models\UserReview`.
 */
class UserReviewSearch extends UserReview
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating_delivery', 'rating_service', 'rating_work'], 'integer'],
            [['created_at', 'user_name'], 'safe'],
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
        $query = UserReview::find();
        $query->joinWith(['user']);

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
            'user_id' => $this->user_id,
            'rating_delivery' => $this->rating_delivery,
            'rating_service' => $this->rating_service,
            'rating_work' => $this->rating_work,
            'created_at' => $this->created_at,
        ]);
        $query->andFilterWhere(['like', 'user.login', $this->user_name]);

        return $dataProvider;
    }
}
