<?php

namespace App\Repositories;

class LanguageRepository extends Repository
{
    public function model(): string
    {
        return \App\Models\Language::class;
    }

    public function relations(): array
    {
        return [];
    }
}
