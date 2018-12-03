<?php

namespace api\modules\v1\controllers;

use common\widgets\Xtrait\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use Redis\RedisInstance;
use yii\base\InlineAction;
use yii\base\InvalidConfigException;

class apiBaseController extends Controller
{
    protected $url_base= 'http://backend.rtmap.com';
    protected $logDir = 'pack_application';

    public function createAction($id)
    {
        if ($id === '') {
            $id = $this->defaultAction;
        }
        $actionMap = $this->actions();
        if (isset($actionMap[$id])) {
            try {
                return \Yii::createObject($actionMap[$id], [$id, $this]);
            } catch (InvalidConfigException $e) {
            }
        } elseif (preg_match('/^[a-zA-Z0-9\\_]+$/', $id)) {
            $methodName = 'action' . ucwords(strtolower($id));
            $method = new \ReflectionMethod($this, $methodName);
            if ($method->isPublic() && $method->getName() === $methodName) {
                return new InlineAction($id, $this, $methodName);
            }
        } elseif (preg_match('/^[a-z0-9\\-_]+$/', $id) && strpos($id, '--') === false && trim($id, '-') === $id) {
            $methodName = 'action' . str_replace(' ', '', ucwords(implode(' ', explode('-', $id))));
            if (method_exists($this, $methodName)) {
                $method = new \ReflectionMethod($this, $methodName);
                if ($method->isPublic() && strtolower($method->getName()) === strtolower($methodName)) {
                    return new InlineAction($id, $this, $methodName);
                }
            }
        }
        return null;
    }
}
