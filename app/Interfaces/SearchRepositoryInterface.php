<?php

namespace App\Interfaces;

interface SearchRepositoryInterface
{
    public function search(string $question): object;
    public function filter(object $collection, string $sortable = 'abc'): object;
}
