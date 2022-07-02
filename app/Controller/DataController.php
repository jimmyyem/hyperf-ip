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
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;

#[Controller(prefix: "data")]
class DataController extends BaseController
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

    #[PostMapping('')]
    public function store()
    {
        $data = $this->request->all();
        $this->logger('app', 'store')->error('data store'.json_encode($data, 256));

        return $this->success();
    }

    #[PutMapping('')]
    public function update()
    {
        return $this->error(404, 'NOT FOUND');
    }

    #[DeleteMapping('')]
    public function remove()
    {
        return $this->error(404, 'NOT FOUND');
    }
}
