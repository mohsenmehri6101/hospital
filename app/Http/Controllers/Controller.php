<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="hospital Api Docs", version="0.1")
 *    @OA\Server(
 *      url="http://127.0.0.1:8000",
 *      description="Demo API Server"
 * )
/**
@OA\SecurityScheme(
 *       securityScheme="bearerAuth",
 *      in = "header",
 *       type="http",
 *       scheme="bearer",
 *      bearerFormat="JWT"
 *  )
 **/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
