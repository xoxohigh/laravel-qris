<?php

namespace FatwaKB\LaravelQRIS\Services;

class TLVService
{
    public static function parse(string $payload): array
    {
        $result = [];

        $position = 0;

        while ($position < strlen($payload)) {

            $tag = substr($payload, $position, 2);

            $length = (int) substr($payload, $position + 2, 2);

            $value = substr(
                $payload,
                $position + 4,
                $length
            );

            $result[$tag] = $value;

            $position += $length + 4;
        }

        return $result;
    }

    public static function build(array $data): string
    {
        $payload = '';

        foreach ($data as $tag => $value) {

            $payload .= sprintf(
                '%s%02d%s',
                $tag,
                strlen($value),
                $value
            );
        }

        return $payload;
    }
}
