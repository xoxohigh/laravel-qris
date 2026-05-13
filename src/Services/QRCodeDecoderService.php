<?php

namespace FatwaKB\LaravelQRIS\Services;

use Zxing\QrReader;
use FatwaKB\LaravelQRIS\Exceptions\QRISDecodeException;

class QRCodeDecoderService
{
    public static function decode(string $path): string
    {
        $qrcode = new QrReader($path);

        $text = $qrcode->text();

        if (!$text) {
            throw new QRISDecodeException(
                'Unable to decode QRIS image.'
            );
        }

        return $text;
    }
}
