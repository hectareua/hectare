<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo_url".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $h1
 * @property string $keywords
 * @property string $description
 * @property string $text
 * @property integer $status
 */
class SeoUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'h1', 'keywords', 'description', 'text'], 'string'],
            [['status'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'title' => 'Title',
            'h1' => 'H1',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'text' => 'Text',
            'status' => 'Status',
        ];
    }

    public static function getCurrent() {
        $urlPath = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        return static::find()->where([
            'OR',
            ['url' => $urlPath],
            ['url' => '/' . $urlPath],
        ])->andWhere(['status' => 1])->one();
    }
}
