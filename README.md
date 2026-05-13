# Laravel QRIS

Convert static QRIS into dynamic QRIS with custom amount support for Laravel and native PHP.

Supports:

- Decode QRIS image
- Parse QRIS payload
- Convert static QRIS to dynamic QRIS
- Add transaction amount
- Generate QR image
- Base64 output
- Save PNG file

---

# Features

- Laravel 10, 11, 12 support
- Native PHP support
- Composer installable
- PSR-4 autoload
- QRIS CRC16 generator
- QRIS TLV parser
- PNG QR generator
- Base64 QR output

---

# Requirements

- PHP 8.2+
- Composer

---

# Installation

## Laravel

```bash
composer require fatwakb/laravel-qris
```

---

## Native PHP

```bash
composer require fatwakb/laravel-qris
```

Then include Composer autoload:

```php
require 'vendor/autoload.php';
```

---

# Laravel Usage

## Generate Dynamic QRIS From Raw String

```php
use QRIS;

$qris = QRIS::fromString(
    '00020101021126670016COM.NOBUBANK.WWW01189360050300000879140214508135781657150303UMI51440014ID.CO.QRIS.WWW0215ID20253777777770303UMI5204541153033605802ID5914TEST MERCHANT6013JAKARTA BARAT6105111116304D41D'
)
->amount(10000)
->base64();

return view('welcome', compact('qris'));
```

---

## Show QRIS In Blade

```html
<img src="data:image/png;base64,{{ $qris }}" />
```

---

## Generate From Uploaded QR Image

```php
use QRIS;

public function generate(Request $request)
{
    $qris = QRIS::fromImage(
        $request->file('qris')->getPathname()
    )
    ->amount(25000)
    ->base64();

    return response()->json([
        'qris' => $qris
    ]);
}
```

---

## Save QRIS PNG File

```php
use QRIS;

QRIS::fromString($rawQris)
    ->amount(50000)
    ->save(
        storage_path('app/public/qris.png')
    );
```

---

# Native PHP Usage

## Generate QRIS

```php
<?php

require 'vendor/autoload.php';

use FatwaKB\LaravelQRIS\QRISManager;

$qris = QRISManager::fromString(
    '00020101021126670016COM.NOBUBANK.WWW01189360050300000879140214508135781657150303UMI51440014ID.CO.QRIS.WWW0215ID20253777777770303UMI5204541153033605802ID5914TEST MERCHANT6013JAKARTA BARAT6105111116304D41D'
)
->amount(10000)
->base64();

echo '<img src="data:image/png;base64,'.$qris.'">';
```

---

## Save QRIS PNG

```php
<?php

require 'vendor/autoload.php';

use FatwaKB\LaravelQRIS\QRISManager;

QRISManager::fromString($rawQris)
    ->amount(10000)
    ->save('qris.png');
```

---

# Available Methods

| Method       | Description                   |
| ------------ | ----------------------------- |
| fromString() | Generate from raw QRIS string |
| fromImage()  | Generate from QR image        |
| amount()     | Set transaction amount        |
| raw()        | Get raw QRIS payload          |
| base64()     | Get base64 QR image           |
| save()       | Save PNG QR image             |

---

# Example Raw Output

```php
$qris = QRIS::fromString($raw)
    ->amount(10000)
    ->raw();

dd($qris);
```

---

# Example Base64 Output

```php
$qris = QRIS::fromString($raw)
    ->amount(10000)
    ->base64();
```

---

# QRIS Static to Dynamic Conversion

The package automatically converts:

```text
010211
```

into:

```text
010212
```

to support dynamic transaction amount.

---

# Supported Output

- Raw QRIS payload
- Base64 PNG
- PNG file

---

# Publish Config (Laravel)

```bash
php artisan vendor:publish --tag=qris-config
```

---

# Testing

```bash
composer test
```

---

# Development

Clone repository:

```bash
git clone https://github.com/xoxohigh/laravel-qris.git
```

Install dependencies:

```bash
composer install
```

Validate Composer:

```bash
composer validate
```

Run autoload dump:

```bash
composer dump-autoload
```

---

# Roadmap

- Recursive TLV parser
- CRC validation
- SVG output
- QR logo support
- Expiration support
- Multi acquirer support

---

# Security

Please validate uploaded image files before processing QRIS payloads.

Recommended:

- Validate MIME type
- Limit upload size
- Sanitize uploaded files

---

# License

MIT License

---

# Author

FatwaKB
