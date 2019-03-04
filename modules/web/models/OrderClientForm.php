<?php

namespace app\modules\web\models;


use app\models\OrderProduct;
use yii\validators\RequiredValidator;

class OrderClientForm extends OrderProduct
{
     public $data, $comment;

     public function rules()
     {
         return [
             [['comment'], 'string'],
             [['data'], 'validateData'],
         ];
     }

    public function validateData($attribute)
    {
        $requiredValidator = new RequiredValidator();

        foreach($this->$attribute as $index => $row) {
            $error = null;
            $requiredValidator->validate($row['product_id'], $error);
            if (!empty($error)) {
                $key = $attribute . '[' . $index . '][product_id]';
                $this->addError($key, 'Заполните поле товара');
            }
        }
    }
}