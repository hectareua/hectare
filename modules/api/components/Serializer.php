<?php

namespace app\modules\api\components;

class Serializer extends \yii\rest\Serializer
{
	public $fields = [];

	public $expand = [];

	public function getRequestedFields()
	{
		return [
			$this->fields,
			$this->expand,
		];
	}
}