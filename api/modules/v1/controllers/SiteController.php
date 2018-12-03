<?php

namespace api\modules\v1\controllers;
use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'message' => 'API test Ok!',
            'code' => 200,
        ];
    }
}
