<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Product;
use app\models\AttributeValue;
use app\models\FieldValue;
use yii\web\UploadedFile;
use app\models\Image;

class ProductForm extends Product
{
    public $imagesData = [];
    public $suggestionsData = [];
    public $alsobuyData = [];
    public $attributeValuesData = [];
    public $fieldValuesData = [];

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imagesData', 'suggestionsData','alsobuyData', 'attributeValuesData', 'fieldValuesData'], 'safe'],
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
        foreach ($this->images as $image)
        {
            $this->imagesData[] = ['imageUrl' => $image->url, 'id' => $image->id];
        }
        foreach ($this->attributeValues as $attrValue)
        {
            $this->attributeValuesData[] = [
                'id' => $attrValue->id,
                'option_id' => $attrValue->option_id,
                'price' => $attrValue->price ,
				'part_price' => $attrValue->part_price ,
                'opt' => $attrValue->opt ,
                'opt_uk' => ($attrValue->opt_uk)/100,
                'opt1' => $attrValue->opt1,
                'opt_uk1' => ($attrValue->opt_uk1)/100,
                'code1c' => $attrValue->code1c,
				'code1c_buh' => $attrValue->code1c_buh,
                'status' => $attrValue->status,
            ];
        }
        foreach ($this->fieldValues as $fieldValue)
        {
            $this->fieldValuesData[] = ['id' => $fieldValue->id, 'option_id' => $fieldValue->option_id];
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            foreach ($this->images as $image)
                $image->delete();
            foreach ($this->attributeValues as $attrValue)
                $attrValue->delete();
            foreach ($this->fieldValues as $fieldValue)
                $fieldValue->delete();
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

            $newImageIds = [];
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
            
            $newSuggestionIds = [];
            $newAlsobuyIds = [];
            if ($this->imagesData) {
                foreach ($this->imagesData as $imageData)
                    if ($imageData['id']){
						$newSuggestionIds[] = $imageData['id'];
						$newAlsobuyIds[] = $imageData['id'];
					}
            }

            $suggestionsToDelete = $this->getSuggestedProducts()->where(['not', ['id' => $newSuggestionIds]])->all();
            foreach ($suggestionsToDelete as $suggestionToDelete)
            {
                $this->unlink('suggestedProducts', $suggestionToDelete, true);
            }

            if ($this->suggestionsData) {
                foreach($this->suggestionsData as $suggestion_id)
                {
                    $suggestedProduct = self::findOne($suggestion_id);
                    if ($suggestedProduct)
                        $this->link('suggestedProducts', $suggestedProduct);
                }
            }
            /*
            $newAlsobuyIds = [];
            if ($this->imagesData) {
                foreach ($this->imagesData as $imageData)
                    if ($imageData['id'])
                        $newAlsobuyIds[] = $imageData['id'];
            }
*/
            $alsobuysToDelete = $this->getAlsobuyProducts()->where(['not', ['id' => $newAlsobuyIds]])->all();
            foreach ($alsobuysToDelete as $alsobuyToDelete)
            {
                $this->unlink('alsobuyProducts', $alsobuyToDelete, true);
            }
            
            if ($this->alsobuyData) {
                foreach($this->alsobuyData as $alsobuy_id)
                {
                    $alsobuyProduct = self::findOne($alsobuy_id);
                    if ($alsobuyProduct)
                        $this->link('alsobuyProducts', $alsobuyProduct);
                }
            }

            $newAttributeValueIds = [];
            if ($this->attributeValuesData) {
                foreach ($this->attributeValuesData as $attributeValueData)
                    if ($attributeValueData['id'])
                        $newAttributeValueIds[] = $attributeValueData['id'];
            }

            $attributeValuesToDelete = $this->getAttributeValues()->where(['not', ['id' => $newAttributeValueIds]])->all();
            foreach ($attributeValuesToDelete as $attributeValueToDelete)
            {
                $this->unlink('attributeValues', $attributeValueToDelete, true);
                $attributeValueToDelete->delete();
            }

            //create
            if ($this->attributeValuesData) {
                foreach($this->attributeValuesData as $attributeValueData)
                {
                    $attributeValue = null;
                    if ($attributeValueData['id'])
                    {
                        $attributeValue = $this->getAttributeValues()->where(['id' => $attributeValueData['id']])->one();
                    }
                    if (!$attributeValue)
                    {
                        $attributeValue = new AttributeValue();
                    }
                    if ($attributeValueData['opt_uk']) {
                        if (strpos('.' ,  $attributeValueData['opt_uk'])) {
                            $attributeValueData['opt_uk'] = str_replace(".", "",  $attributeValueData['opt_uk']);
                        } else {
                            $attributeValueData['opt_uk'] = $attributeValueData['opt_uk']*100;

                        }
                    }
                    if ($attributeValueData['opt_uk1']) {
                        if (strpos('.' ,  $attributeValueData['opt_uk1'])) {
                            $attributeValueData['opt_uk1'] = str_replace(".", "",  $attributeValueData['opt_uk1']);
                        } else  {
                            $attributeValueData['opt_uk1'] = $attributeValueData['opt_uk1']*100;
                        }
                    }

                    $attributeValue->setAttributes($attributeValueData);

                    $this->link('attributeValues', $attributeValue);
                }
            }

            $newFieldValueIds = [];

            if ($this->fieldValuesData) {
                foreach ($this->fieldValuesData as $fieldValueData)
                    if ($fieldValueData['id'])
                        $newFieldValueIds[] = $fieldValueData['id'];
            }


            $fieldValuesToDelete = $this->getFieldValues()->where(['not', ['id' => $newFieldValueIds]])->all();
            foreach ($fieldValuesToDelete as $fieldValueToDelete)
            {
                $this->unlink('fieldValues', $fieldValueToDelete, true);
                $fieldValueToDelete->delete();
            }

            //create
            if ($this->fieldValuesData) {
                foreach($this->fieldValuesData as $fieldValueData)
                {
                    $fieldValue = null;
                    if ($fieldValueData['id'])
                    {
                        $fieldValue = $this->getFieldValues()->where(['id' => $fieldValueData['id']])->one();
                    }
                    if (!$fieldValue)
                    {
                        $fieldValue = new FieldValue();
                    }
                    $fieldValue->setAttributes($fieldValueData);
                    $this->link('fieldValues', $fieldValue);
                }
            }

            $transaction->commit();
            return true;
        }
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }
}
