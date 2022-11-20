<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageDestroyRequest;
use App\Http\Requests\Language\LanguageShowRequest;
use App\Http\Requests\Language\LanguageStoreRequest;
use App\Http\Requests\Language\LanguageUpdateRequest;
use App\Http\Requests\Language\LanguageIndexRequest;

class LanguageController extends Controller
{
    public LanguageLogic $languageLogic;

    public function __construct(LanguageLogic $languageLogic)
    {
        $this->languageLogic = $languageLogic;
    }

    public function index(LanguageIndexRequest $request)
    {
        $courseTemplates = $this->languageLogic->index($request);
        $response = ['languages' => $courseTemplates];
        return response_standard(data: $response);
    }

    public function store(LanguageStoreRequest $request)
    {
        $language = $this->languageLogic->store($request);
        $data = ['language' => $language];
        return response_standard(data: $data,message: 'store_success');
    }

    public function update(LanguageUpdateRequest $request, $id)
    {
        $language = $this->languageLogic->update($request,$id);
        $data = ['language' => $language];
        return response_standard(data: $data,message: 'store_success');
    }

    public function destroy(LanguageDestroyRequest $id)
    {
        $status_destroy = $this->languageLogic->destroy($id);
        return $status_destroy ? response_standard(message: __('custom.defaults.delete_success')) : response_standard(message: __('custom.defaults.delete_failed'), status: 500);
    }

    public function show(LanguageShowRequest $id)
    {
        $language = $this->languageLogic->show($id);
        $response = ['language' => $language];
        return response_standard(data:$response);
    }
}
