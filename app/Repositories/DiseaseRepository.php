<?php

namespace App\Repositories;

class DiseaseRepository extends Repository
{
    public function model(): string
    {
        return \App\Models\User::class;
    }

    public function relations(): array
    {
        return ['location', 'contact'];
    }
}
