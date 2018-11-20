<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 19/11/18
 * Time: 下午6:59
 */

namespace api\modules\v1\controllers;

use CommonPublic\PublicService;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use Log\LogService;
class PackageController extends apiBaseController
{

    /**
     * 获取空闲车位数
     * @throws \Exception
     */
    public function actionGetfreeparking()
    {
        $parames =\Yii::$app->request->get();
        $key_admin = $parames['key_admin'];
        $mer_chant = PublicService::getInstance()->getMerchant($key_admin);
        $data['key_admin'] = $key_admin;
        $data['sign_key'] = $mer_chant['signkey'];
        $data['sign'] = sign($data);
        unset($data['sign_key']);
        $url =  $this->url_base . 'Parkservice/Parkoutput/get_left_park';
        $Client = new Client([
                'base_uri'=>$url,
            ]
        );
        try {
            $memInfo = $Client->request('POST',
                $url, [
                    'query' => $data,
                    'timeout' => 5,
                    'on_stats' => function (TransferStats $stats) {
                        LogService::getInstance(baseClassName(__CLASS__), $this->logDir)->guzzleInfo($stats);
                    }
                ]);
            $data = json_decode($memInfo->getBody(), true);
            // 查询商场配置的logo
            $re = PublicService::getInstance()->getOneAmindefault($key_admin, 'logo');
            if (!empty($re) && is_string($re)) {
                $data['logo'] = $re;
            } else {
                $data['logo'] = '';
            }
            $data['localstorage'] = $mer_chant['is_localstorage'];
            echo json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }catch (\Exception $exception){
            $message = [
                'code' => -2,
                'msg'  => $exception->getMessage()
            ];
            echo json_encode($message,JSON_UNESCAPED_UNICODE);die;
        }
    }

}