<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InfoSlider;

/**
 * InfoSliderSearch represents the model behind the search form about `app\models\InfoSlider`.
 */
class InfoSliderSearch extends InfoSlider
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id'], 'integer'],
            [['link_uk', 'title_uk', 'desc_uk'], 'safe'],
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
        $query = InfoSlider::find();

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
            'image_id' => $this->image_id,
        ]);

        $query->andFilterWhere(['like', 'link_uk', $this->link_uk])
            ->andFilterWhere(['like', 'title_uk', $this->title_uk])
            ->andFilterWhere(['like', 'desc_uk', $this->desc_uk]);

        return $dataProvider;
    }
}
