<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2017
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

namespace Process;


use FastD\Packet\Json;
use FastD\Process\AbstractProcess;
use swoole_process;
use swoole_client;

/**
 * Class HeartBeat
 * @package Process
 */
class HeartBeat extends AbstractProcess
{
    public function handle(swoole_process $swoole_process)
    {
        $client = client(config()->get('register.host'), true, false);
        $client->on('connect', function ($client) {

        });
        $client->on('receive', function (swoole_client $client, $data) {
        });
        $client->on('close', function ($client) {

        });
        $client->start();
        $interval = 1000;

        timer_tick($interval, function () use ($client, &$interval) {
            if ($client->isConnected()) {
                $client->send(Json::encode($this->serverInfo()));
            } else {
                $interval = 5000;
                $client->connect();
            }
        });
    }

    public function serverInfo()
    {
        return [
            'name'      => app()->getName(),
            'pid'       => server()->getPid(),
            'sock'      => server()->getSocketType(),
            'host'      => server()->getHost(),
            'port'      => server()->getPort(),
            'stats'     => server()->getSwoole()->stats(),
            'error'     => 0,
            'time'      => time()
        ];
    }
}