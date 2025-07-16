# SecureApiServer

[![License](https://img.shields.io/github/license/artapamudaid/SecureApiServer.svg)](LICENSE)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/artapamudaid/secure-api-server.svg)](https://packagist.org/packages/artapamudaid/secure-api-server)
[![CI](https://github.com/artapamudaid/SecureApiServer/actions/workflows/test.yml/badge.svg)](https://github.com/artapamudaid/SecureApiServer/actions)
[![Tested Laravel Versions](https://img.shields.io/badge/Laravel-8%2C9%2C10%2C11-green)](https://laravel.com)

A secure API authentication package for Laravel using API Key + Secret + HMAC signature with nonce & timestamp validation.  
Built for protecting internal or third-party API calls with full management support.

---

## ✨ Features

- 🔑 Generate secure API Key & Secret
- 🔐 Validate signature using HMAC
- 🕒 Protects with `X-TIMESTAMP` and `X-NONCE`
- 🚫 Revoke or delete API Keys
- 👤 Enforce one key per user
- 📦 Fully tested with PHPUnit 12

---

## 📦 Installation (via Packagist)

```bash
composer require artapamudaid/secure-api-server
```

Lalu:

```bash
php artisan vendor:publish --tag=config
php artisan migrate
```
---

⚙️ Configuration
----------------

Konfigurasi berada di `config/apikey.php`:

```bash

return [
    'enabled' => true,
    'timestamp_tolerance' => 300, // in seconds (default 5 minutes)
];
```
---

🚀 API Endpoints
----------------

| Method | Endpoint | Description |
| --- | --- | --- |
| POST | `/secure-api/key` | Generate API key + secret |
| GET | `/secure-api/keys` | List all API keys |
| DELETE | `/secure-api/key/{id}` | Delete API key |
| PATCH | `/secure-api/key/{id}/revoke` | Revoke API key |
| POST | `/secure-api/ping` | Test secure endpoint |

---

🧾 Required Headers for Secured Endpoints
-----------------------------------------

```bash
X-API-KEY: {api_key}
X-API-SIGNATURE: {hmac_signature}
X-TIMESTAMP: {unix_timestamp}
X-NONCE: {random_string}
```

### HMAC Signature format:

```bash
HMAC_SHA256(api_key . nonce . timestamp, secret)
```

* * * * *

🧪 Running Tests
----------------

```bash
composer install
vendor/bin/phpunit
```

Dibangun menggunakan:

-   PHPUnit ^12.0

-   Orchestra Testbench (Laravel testing framework)

* * * * *

🛡 Laravel Compatibility
------------------------

| Laravel Version | Support |
| --- | --- |
| 8.x | ✅ |
| 9.x | ✅ |
| 10.x | ✅ |
| 11.x | ✅ |