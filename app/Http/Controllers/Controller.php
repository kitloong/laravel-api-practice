<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "Laravel Swagger OpenApi",
    title: "Laravel OpenApi",
    contact: new OA\Contact(email: "kitloong1008@gmail.com")
)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST,
    description: "L5 Swagger OpenApi dynamic host server"
)]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
