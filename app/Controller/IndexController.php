<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

#[Controller(prefix: "")]
class IndexController extends AbstractController
{
    #[GetMapping('')]
    public function index()
    {
        return [
            'ip' => $this->getIpAddress(),
            'time' => date('Y-m-d H:i:s'),
            'server_params' => $this->request->getServerParams(),
            'request' => $this->request->all(),
        ];
    }

    /**
     * 获取IP地址
     *
     * @return mixed|string
     */
    private function getIpAddress()
    {
        $res = $this->request->getServerParams();
        if (isset($res['http_client_ip'])) {
            return $res['http_client_ip'];
        } elseif (isset($res['http_x_real_ip'])) {
            return $res['http_x_real_ip'];
        } elseif (isset($res['http_x_forwarded_for'])) {
            //部分CDN会获取多层代理IP，所以转成数组取第一个值
            $arr = explode(',', $res['http_x_forwarded_for']);

            return $arr[0];
        } else {
            return $res['remote_addr'];
        }
    }
}
