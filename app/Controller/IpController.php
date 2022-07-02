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

#[Controller(prefix: "ip")]
class IpController extends BaseController
{
    #[GetMapping('')]
    public function index()
    {
        return $this->success([
            'ip' => $this->getIpAddress(),
            'time' => date('Y-m-d H:i:s'),
            'server_params' => $this->request->getServerParams(),
            'request' => $this->request->all(),
        ]);
    }
}
