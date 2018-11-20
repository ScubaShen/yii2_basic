<?php

namespace api\modules\v1\controllers;

use common\widgets\Xtrait\Response;
use yii\filters\AccessControl;
use yii\web\Controller;


class apiBaseController extends Controller
{
    protected $url_base= 'http://backend.rtmap.com/';
    protected $logDir = 'pack_application';
}
