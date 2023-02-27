<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/NTPLite.php';

use Workerman\Worker;
use Workerman\Timer;
use Workerman\Connection\UdpConnection;

$GlobalData = new GlobalData\Server('127.0.0.1', 2207);
$ntp_worker = new Worker('udp://127.0.0.1:123');
$ntp_worker->name = 'NTP Service';
$ntp_worker->onWorkerStart = function () {
    global $global;
    $global = new GlobalData\Client('127.0.0.1:2207');
    $global->add('is_limited', false);
    $global->add('query_now', 0);
    echo "Worker started!\n";
    $time_interval = 1;
    Timer::add(
        $time_interval,
        function () {
            global $global;
            echo "query:$global->query_now, is_limit:";
            echo $global->is_limited ? 1 : 0;
            echo "\nTimer act, clear list.\n";
            $global->query_now = 0;
            $global->is_limited = false;
        }
    );
    echo "Timer added!\n";
};
$ntp_worker->onMessage = function (UdpConnection $connection, $data) {
    global $global;
    $global->query_now++;
    if ($global->query_now > 2)
    {
        $global->is_limited = true;
        $connection->close(0x0);
    }
    if (!$global->is_limited and $connection->getRemoteIp()) {
        $NTP = new NTPLite();
        if (!$NTP->readMessage($data)) {
            $hex = '';
            for ($i = 0; $i < strlen($data); $i++) {
                $hex .= sprintf('%02x', ord($data[$i]));
            }
            echo "Bad request, aborted\n$hex\n";
        } else {
            //$NTP->dump();
            //echo "\n", $NTP;
            $NTP->leapIndicator = 0;
            $NTP->mode = 4;
            $NTP->stratum = 3;
            $NTP->precision = -20;
            $NTP->rootDelay = 0;
            $NTP->rootDispersion = 0.0120;
            $NTP->referenceIdentifier = ip2long('202.38.64.7');
            $now = new DateTime(NULL);
            $NTP->referenceTimestamp = NTPLite::convertDateTimeToSntp($now);
            $NTP->originateTimestamp = $NTP->transmitTimestamp;
            $NTP->receiveTimestamp = NTPLite::convertDateTimeToSntp($now);
            $NTP->transmitTimestamp = NTPLite::convertDateTimeToSntp($now);
            $message = $NTP->writeMessage();
            unset($NTP);
            $connection->close($message);
        }
    }
};

Worker::runAll();
