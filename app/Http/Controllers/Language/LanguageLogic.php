<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Logic;
use App\Http\Requests\Language\LanguageIndexRequest;
use App\Http\Requests\Language\LanguageStoreRequest;
use App\Http\Requests\Language\LanguageUpdateRequest;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class LanguageLogic extends Logic
{
    public LanguageRepository $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function index(LanguageIndexRequest $request)
    {
        $inputs = $request->validated();
        return $this->languageRepository->resolve_paginate(inputs: $inputs);
    }


    public function store(LanguageStoreRequest $request)
    {
        $inputs = $request->validated();
        return $this->languageRepository->create($inputs);
    }

    public function show($id)
    {
        return $this->languageRepository->findOrFail($id);
    }

    public function update(LanguageUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $language = $this->languageRepository->findOrFail($id);
        return $this->languageRepository->update($language, $data);
    }


    public function destroy(/*LanguageDestroyRequest*/Request $id)
    {
        $language = $this->languageRepository->findOrFail($id);
        return $this->languageRepository->delete($language);
    }

}
