<?php

namespace app\modules\admin\models\traits;

use Yii;
use yii\web\UploadedFile;
use app\models\Image;

trait TwoImagesUpload
{

    use \app\modules\admin\models\traits\ImageBaseUpload;

    /**
     * @var string
     */
    public $imageUrl;
    public $imageUrlTwo;

    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imageFileTwo;


    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imageUrl'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'imageUrl' => 'URL зображення',
            'imageFile' => 'Файл зображення',
            'imageUrlTwo' => 'URL зображення 2',
            'imageFileTwo' => 'Файл зображення 2',
        ]);
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($this->image)
            $this->imageUrl = $this->image->url;
        if ($this->imageTwo)
            $this->imageUrlTwo = $this->imageTwo->url;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            if ($this->image)
                $this->image->delete();
            if ($this->imageTwo)
                $this->imageTwo->delete();;
            return true;
        }
        return false;
    }

    public function saveForm()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
            $imageTwo = null;
            $image = null;

            if ($this->imageFile) {
                $image = $this->saveImage($this->image, $this->imageFile, $this->imageUrl);
                if ($image) {
                    $this->image_id = $image->id;
                }
            }


            if ($this->imageFileTwo) {

                $imageTwo = $this->saveImage($this->imageTwo, $this->imageFileTwo, $this->imageUrlTwo);
                if ($imageTwo) {
                    $this->image_two_id = $imageTwo->id;
                }
            }

            //$this->image_id = $image->id;

            if ($this->save())
            {
                $transaction->commit();
                return true;
            }
        }
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }

}
