<?php
namespace common\widgets\Xtrait;

trait Response
{

    private $terror = "terror";
    private $tsuccess = "tsuccess";
    private $successCode = 200;
    private $errorCode = 500;

    
    /**
     * 成功
     * @param string $errorMsg
     * @param string $url
     */
    public function responseSuccess($errorMsg='', $url=''){
        $errorMsgTmp = [];
        $errorMsgTmp['msgType'] = $this->tsuccess;
        $errorMsgTmp['msg'] = $errorMsg;
        return $this->response($url, $this->successCode, $errorMsgTmp);
    }

    /**
     * 跳转
     *
     * @param $url
     */
    public function responseRedirect($url)
    {
        $errorMsgTmp = [];
        $errorMsgTmp['msgType'] = $this->tsuccess;
        $errorMsgTmp['msg'] = '';
        return $this->response($url, $this->successCode, $errorMsgTmp);
    }

    /**
     * 错误
     * @param string $errorMsg
     * @param string $url
     */
    public function responseError($errorMsg='', $url=''){
        $errorMsgTmp = [];
        $errorMsgTmp['msgType'] = $this->terror;
        $errorMsgTmp['msg'] = $errorMsg;
        return $this->response($url, $this->errorCode, $errorMsgTmp);
    }

    public function response($data=[], $errorCode = '200', $errorMsg = '')
    {
        $result = [];
        $result['data'] = $data;
        $result['code'] = $errorCode;
        $result['msg'] = $errorMsg;
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}