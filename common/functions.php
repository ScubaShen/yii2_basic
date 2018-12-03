<?php
/**
 *  公共方法库
 * Created by PhpStorm.
 * User: zhangying
 */

if (!function_exists('baseClassName')) {
    function baseClassName ($className)
    {
        return strtolower(basename(str_replace('\\', '/', $className)));
    }
}

if (!function_exists('sign')) {
    function sign(array $params, $string = '', $isnull = false)
    {
        ksort($params);
        $str = '';
        if ($isnull === true) {//空值不参与签名
            foreach ($params as $k => $v) {
                if ($v !== ''){
                    if ('' == $str) {
                        $str .= $k . '=' . trim($v);
                    } else {
                        $str .= '&' . $k . '=' . trim($v);
                    }
                }

            }
        }else{
            foreach ($params as $k => $v) {
                if ('' == $str) {
                    $str .= $k . '=' . trim($v);
                } else {
                    $str .= '&' . $k . '=' . trim($v);
                }
            }
        }

        $str = $string == false ? $str : $str . $string;//如果有拼接参数，则将参数拼接在后面
        $sign=md5($str);
        $params['str'] = $str;
        $params['sign']=$sign;
        return $sign;
    }
}

