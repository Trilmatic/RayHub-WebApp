<?php

namespace App\Processes\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

final class ScanLocalSource
{
    public function handle($payload)
    {
        $path = $payload->get('path');

        $payload->put('ip', $this->getIp());

        if ($entries = scandir($path)) {
            $entries = array_diff($entries, array('.', '..'));
        } else {
            throw new \Exception('Local source cannot be scanned.', 6542);
        }

        $payload->put('entries', $entries);
        return $payload;
    }

    public function getIp()
    {
        $ip = null;

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
