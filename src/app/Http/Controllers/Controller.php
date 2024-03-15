<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="0.0.1",
 *      title="Holiday Plans - Docs",
 *      description="API documentation for the <b>Holiday Plans</b> project",
 *      @OA\Contact(
 *          email="yuricaparelliofc@gmail.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url="http://localhost:8001/api",
 *      description="API url"
 * )
 *
 * @OA\SecurityScheme(
 *      type="apiKey",
 *      description="Insert the token in the format: <b>Bearer {token}</b>",
 *      in="header",
 *      name="Authorization",
 * 		scheme="sanctum",
 * 		securityScheme="sanctum"
 * )
 *
 */

/**
 * Class Controller
 *
 * This is the base controller class that all other controllers extend from.
 * It includes traits for authorizing requests and validating requests.
 */
class Controller extends BaseController
{
    /**
     * This trait is for authorizing requests.
     * It provides methods to determine if a user is authorized to perform a given action.
     */
    use AuthorizesRequests;

    /**
     * This trait is for validating requests.
     * It provides methods to validate incoming HTTP requests with a variety of powerful validation rules.
     */
    use ValidatesRequests;
}
