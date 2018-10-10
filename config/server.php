<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

return [
    'host' => '0.0.0.0:9999',
    'class' => \FastD\Servitization\Server\HTTPServer::class,
    'options' => [
        'pid_file' => __DIR__ . '/../runtime/pid/' . app()->getName() . '.pid',
        'log_level' => 5,
        'worker_num' => 10,
        'task_worker_num' => 20,
    ],
    'processes' => [
        // 添加发现服务提供器
        \FastD\RegistryProvider\Process\RegisterProcess::class,
    ],
    'listeners' => [

    ],
];