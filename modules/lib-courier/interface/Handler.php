<?php
/**
 * Handler
 * @package lib-courier
 * @version 0.0.1
 */

namespace LibCourier\Iface;


interface Handler
{

    static function cost(array $data): ?array;

    static function track(string $courier, string $courier_receipt): ?array;

    static function lastError(): ?string;
}