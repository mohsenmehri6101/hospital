<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageDestroyRequest;
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

    /**
     * @OA\Post(
     *      path="/api/v1/order/register",
     *      operationId="addorder",
     *      tags={"order"},
     *      summary="ثبت سفارش",
     *      description="User Register here",
     *     @OA\Parameter(
     *         name="x-api-key",
     *         in="header",
     *         description="api token",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *       @OA\JsonContent( required={"email","password"},
     *       @OA\Property(property="receiver_name", type="string", format="email", example="salman"),
     *       @OA\Property(property="receiver_phone", type="string", example="05138794582"),
     *       @OA\Property(property="receiver_mobile", type="string", example="09388985617"),
     *       @OA\Property(property="receiver_address", type="string", example="delavaran st haq shenas 2/3"),
     *       @OA\Property(property="receiver_postal_code", type="number", example="12345"),
     *       @OA\Property(property="factor", type="number", example="959"),
     *       @OA\Property(property="delivery_type", type="string", example="cheeta"),
     *     @OA\Property(property="seller", type="string", example="f111111"),
     *       @OA\Property(property="payment_type", type="string",  example="cod"),
     *       @OA\Property(property="risk_level", type="number", example="2"),
     *       @OA\Property(property="price", type="number", example="20000"),
     *       @OA\Property(property="weight", type="number", example="25"),
     *       @OA\Property(property="volume", type="number", example="0"),
     *       @OA\Property(property="destination_city", type="number", example="73541"),
     *       @OA\Property(property="destination_area", type="number", example="1653542398"),
     *       @OA\Property(property="lat", type="string", example="36.33"),
     *       @OA\Property(property="lng", type="string", example="59.53"),
     *       @OA\Property(property="sms_notify", type="boolean", example="0"),
     *       @OA\Property(property="free_send", type="boolean", example="0"),
     *       @OA\Property(property="status", type="boolean", example="0"),
     *       @OA\Property(property="products", type="array"
     *               ,@OA\Items(
     *              @OA\Property(property="product_id", type="number", example="201"),
     *              @OA\Property(property="name", type="string", example="salman"),
     *              @OA\Property(property="price", type="number", example="5000"),
     *               @OA\Property(property="count", type="number", example="50"),
     *               description="order barcodes"
     *         ))
     *     ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     *     )
     */
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

    public function show($id)
    {
        $language = $this->languageLogic->show($id);
        $response = ['language' => $language];
        return response_show(data:$response);
    }
}
