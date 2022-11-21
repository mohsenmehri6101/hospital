<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageDestroyRequest;
use App\Http\Requests\Language\LanguageShowRequest;
use App\Http\Requests\Language\LanguageStoreRequest;
use App\Http\Requests\Language\LanguageUpdateRequest;
use App\Http\Requests\Language\LanguageIndexRequest;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public LanguageLogic $languageLogic;

    public function __construct(LanguageLogic $languageLogic)
    {
        $this->languageLogic = $languageLogic;
    }

    /**
     * @OA\Get(
     *      path="/api/languages/",
     *      operationId="langugage_index",
     *      tags={"languages"},
     *      summary="لیست زبان های ثبت شده در برنامه",
     *      security={
     *          {"bearerAuth":{}},
     *      },
     *     @OA\Parameter(
     *        name="name_english",
     *         in="path",
     *         description="name_english",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="name_persian",
     *         in="path",
     *         description="name_persian",
     *         required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="Ha ocurrido un error."
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="No se ha autenticado, ingrese el token."
     *      ),
     *  )
     */
    public function index(LanguageIndexRequest $request): JsonResponse
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
