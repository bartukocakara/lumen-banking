<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\ApiResponseTrait;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Banking API",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(
 *             email="apiteam@swagger.io"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         description="OpenApi host",
 *         url=SWAGGER_LUME_CONST_HOST
 *     ),
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Swagger",
 *         url="http://swagger.io"
 *     )
 * )
 */
class Controller extends BaseController
{
    use ApiResponseTrait;

    // 1 - Validate payload


    // 2 - Log payload to jso
}
