<?php

namespace FatwaKB\LaravelQRIS\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeGeneratorService
{
    public static function png(string $payload): string
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($payload)
            ->size(400)
            ->margin(10)
            ->build();

        return $result->getString();
    }

    public static function base64(string $payload): string
    {
        return base64_encode(
            self::png($payload)
        );
    }

    public static function save(
        string $payload,
        string $path
    ): bool {
        return file_put_contents(
            $path,
            self::png($payload)
        ) !== false;
    }
}
