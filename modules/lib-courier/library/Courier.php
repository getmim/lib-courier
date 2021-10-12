<?php
/**
 * Courier
 * @package lib-courier
 * @version 0.0.1
 */

namespace LibCourier\Library;


class Courier
{
    protected static string $lastError;

    protected static function setError(string $error) {
        self::$lastError = $error;
        return null;
    }

    public static function cost(array $data): ?array {
        $handlers = \Mim::$app->config->libCourier->handlers;

        $used_handlers = [];

        foreach ($data['courier'] as $courier) {
            if (!isset($handlers->$courier))
                continue;

            $handler = $handlers->$courier;
            if (!isset($used_handlers[$handler])) {
                $used_handlers[$handler] = [];
            }

            $used_handlers[$handler][] = $courier;
        }

        $result = [];

        foreach ($used_handlers as $handler => $couriers) {
            $data['courier'] = $couriers;
            $res = $handler::cost($data);
            if ($res) {
                $result = array_merge($result, $res);
            }
        }

        return $result;
    }

    public static function track(string $courier, string $receipt): ?array {
        $handlers = \Mim::$app->config->libCourier->handlers;
        if (!isset($handlers->$courier)) {
            return self::setError('No handler found for courier ' . $courier);
        }

        $handler = $handlers->$courier;

        $result = $handler::track($courier, $receipt);
        if (!$result) {
            return self::setError($handler::lastError());
        }

        return $result;
    }

    public static function lastError() {
        return self::$lastError;
    }
}
