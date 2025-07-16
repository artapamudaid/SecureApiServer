<?php

namespace Artapamudaid\SecureApiServer\Traits;

trait HasSignature
{
    public function generateSignature($apiKey, $nonce, $timestamp, $secret)
    {
        return hash_hmac('sha256', $apiKey.$nonce.$timestamp, $secret);
    }
}