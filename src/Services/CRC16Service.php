<?php

namespace FatwaKB\LaravelQRIS\Services;

class CRC16Service
{
    public static function generate(string $payload): string
    {
        $crc = 0xFFFF;

        for ($c = 0; $c < strlen($payload); $c++) {

            $crc ^= ord($payload[$c]) << 8;

            for ($i = 0; $i < 8; $i++) {

                if ($crc & 0x8000) {
                    $crc = ($crc << 1) ^ 0x1021;
                } else {
                    $crc <<= 1;
                }

                $crc &= 0xFFFF;
            }
        }

        return strtoupper(
            str_pad(
                dechex($crc),
                4,
                '0',
                STR_PAD_LEFT
            )
        );
    }
}
