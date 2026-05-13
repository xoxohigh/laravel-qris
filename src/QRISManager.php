<?php

namespace FatwaKB\LaravelQRIS;

use FatwaKB\LaravelQRIS\Contracts\QRISInterface;
use FatwaKB\LaravelQRIS\Services\TLVService;
use FatwaKB\LaravelQRIS\Services\CRC16Service;
use FatwaKB\LaravelQRIS\Services\QRCodeDecoderService;
use FatwaKB\LaravelQRIS\Services\QRCodeGeneratorService;

class QRISManager implements QRISInterface
{
    protected array $data = [];

    public static function fromImage(string $path): self
    {
        $payload = QRCodeDecoderService::decode($path);

        return self::fromString($payload);
    }

    public static function fromString(string $string): self
    {
        $instance = new self();

        $instance->data = TLVService::parse($string);

        return $instance;
    }

    public function amount(
        int|string $amount
    ): self {

        /*
         * Static -> Dynamic
         */
        $this->data['01'] = '12';

        /*
         * Transaction amount
         */
        $this->data['54'] = (string) $amount;

        return $this;
    }

    protected function rebuild(): string
    {
        unset($this->data['63']);

        $payload = TLVService::build(
            $this->data
        );

        $payload .= '6304';

        $crc = CRC16Service::generate(
            $payload
        );

        return $payload . $crc;
    }

    public function raw(): string
    {
        return $this->rebuild();
    }

    public function base64(): string
    {
        return QRCodeGeneratorService::base64(
            $this->rebuild()
        );
    }

    public function save(string $path): bool
    {
        return QRCodeGeneratorService::save(
            $this->rebuild(),
            $path
        );
    }
}
