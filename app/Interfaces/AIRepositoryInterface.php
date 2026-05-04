<?php

namespace App\Interfaces;

interface AIRepositoryInterface
{
    public function summarize(string $text): array;
}