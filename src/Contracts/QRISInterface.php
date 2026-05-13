<?php

namespace FatwaKB\LaravelQRIS\Contracts;

interface QRISInterface
{
    public static function fromImage(string $path): self;

    public static function fromString(string $string): self;

    public function amount(int|string $amount): self;

    public function raw(): string;

    public function base64(): string;

    public function save(string $path): bool;
}
