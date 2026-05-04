<?php

namespace App\Interfaces;

interface AIServiceInterface
{
    public function summarize(string $key, string $text): array;
}