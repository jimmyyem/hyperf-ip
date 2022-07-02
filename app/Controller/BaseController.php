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

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class BaseController extends AbstractController
{
    /**
     * @param mixed|null $data
     * @param int $code
     * @param string $msg
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function success(mixed $data = null, int $code = 0, string $msg = '')
    {
        return $this->make($code, $msg, $data);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param mixed $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function error(int $code = 500, string $msg = '', mixed $data = null)
    {
        return $this->make($code, $msg, $data);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param mixed $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function make(int $code, string $msg, mixed $data)
    {
        return $this->response->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
            'ts' => microtime(true),
            'rq' => $this->request->url(),
        ]);
    }

    /**
     * 获取IP地址
     *
     * @return mixed|string
     */
    protected function getIpAddress()
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

    /**
     * @param string $name
     * @param $config
     * @return mixed
     */
    protected function logger(string $name = 'Log', $config = 'default')
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($name, $config);
    }
}
