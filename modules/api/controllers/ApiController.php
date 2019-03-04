<?php

namespace app\modules\api\controllers;

use yii\rest\Controller;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;

class ApiController extends Controller
{
    public $serializer = [
        'class' => 'app\modules\api\components\Serializer',
    ];

	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    
	    // remove authentication filter
	    $auth = $behaviors['authenticator'];
	    unset($behaviors['authenticator']);
	    
	    // add CORS filter
	    $behaviors['corsFilter'] = [
	        'class' => \yii\filters\Cors::className(),
	    ];
	    
	    // re-add authentication filter
	    $behaviors['authenticator'] = $auth;
	    // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
	    $behaviors['authenticator']['except'] = ['options'];

	    $behaviors['contentNegotiator']['formats'] = ['application/json' => Response::FORMAT_JSON];
	    
	    return $behaviors;
	}
}