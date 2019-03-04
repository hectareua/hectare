<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class NewsController extends ApiController
{
	public function actionIndex($page, $items)
	{
      $paginationParams = ['page' => $page, 'pageSize' => $items];
      $this->serializer['fields'] = ['id', 'title_uk', 'title_ru','text_uk','text_ru', 'image'];
      return new ActiveDataProvider([
          'pagination' => $paginationParams,
          'query' => News::find()
              ->where(['and',
                	['<', 'publishing_since', new Expression('NOW()')],
                	['or',
                		['publishing_till' => 0],
                		['>', 'publishing_till', new Expression('NOW()')],
                	],
                ])->orderBy(['publishing_since' => SORT_DESC])
      ]);
	}
    public function actionCount()
    {
        return News::find()
            ->where(['and',
                ['<', 'publishing_since', new Expression('NOW()')],
                ['or',
                    ['publishing_till' => 0],
                    ['>', 'publishing_till', new Expression('NOW()')],
                ],
            ])->count();
    }
    
	public function actionItem($id)
    {
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => News::find()
                ->where(['id' => $id])
        ]);
    }
      public function actionMobileRu($id)
    {
        $news = News::find()->where(['id' => $id])->one();
        $data_ru = "<div style='padding: 20px'><img width='100%' height='100%' src='".$news->image->url."'>".
            "<h4>".$news->title_ru."</h4><br>".$news->text_ru."</div>";

        return $data_ru;
    }

    public function actionMobileUkr($id)
    {
        $news = News::find()->where(['id' => $id])->one();
        $data_uk = "<div style='padding: 20px'><img width='100%' height='100%' src='".$news->image->url."'>".
            "<h4>".$news->title_uk."</h4><br>".$news->text_uk."</div>";
        
        return $data_uk;
    }
}
