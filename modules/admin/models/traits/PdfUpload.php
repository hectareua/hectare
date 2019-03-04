<?php

namespace app\modules\admin\models\traits;

use Yii;
use yii\web\UploadedFile;
use app\models\Image;

trait PdfUpload
{

    /**
     * @var string
     */

    public $imagesData = [];
    public $imageUrl, $imageFile, $imageUrlTwo, $imageFileTwo, $pdfFile;



    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imagesData', 'imageUrl', 'imageFile', 'imageUrlTwo', 'imageFileTwo'], 'safe'],
            [['pdfFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'imagesData' => 'URL зображення',
        ]);
    }

    public function afterFind()
    {
        parent::afterFind();
       // print_r($this->images);die;
        foreach ($this->images as $image) {
            $this->imagesData[] = ['imageUrl' => $image->url, 'id' => $image->id];
        }
        if ($this->image)
            $this->imageUrl = $this->image->url;
        if ($this->imageTwo)
            $this->imageUrlTwo = $this->imageTwo->url;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            foreach ($this->images as $image)
                $image->delete();
            if ($this->image)
                $this->image->delete();
            if ($this->imageTwo)
                $this->imageTwo->delete();
            return true;
        }
        return false;
    }

    public function saveForm()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
            if (!$this->save())
            {
                return false;
            }


            $image = null;
            $imageTwo = null;
            $newImageIds = [];

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
            foreach ($this->imagesData as $imageData)
                if ($imageData['id'])
                    $newImageIds[] = $imageData['id'];

            $imagesToDelete = $this->getImages()->where(['not', ['id' => $newImageIds]])->all();
            foreach ($imagesToDelete as $imageToDelete)
            {
                $this->unlink('images', $imageToDelete, true);
                $imageToDelete->delete();
            }

            //create


            foreach($this->imagesData as $imageData)
            {
                $image = null;
                if ($imageData['id'])
                {
                    $image = $this->getImages()->where(['id' => $imageData['id']])->one();
                }
                if (!$image)
                {
                    $image = new Image();
                }

                if ($imageData['imageFile'])
                {
                    if ($image->saveUploadedFile($imageData['imageFile']))
                        $this->link('images', $image);
                }
                elseif ($imageData['imageUrl'] && $image->url != $imageData['imageUrl'])
                {
                    if ($image->saveUrl($imageData['imageUrl']))
                        $this->link('images', $image);
                }
            }

            if ($this->save() && $this->upload())
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

    public function upload()
    {
        if ($this->validate()) {

            if(!empty($this->pdfFile)){
                $this->pdfFile->saveAs('pdf/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
                return true;
            }
            return true;

        } else {
            return false;
        }
    }

}
