<?php

namespace App\Annotations\OpenApi\ControllerAnnotations\RegisterController;

class AnnotationsRegister
{
    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="createUser",
     *      tags={"Register"},
     *      summary="Create a new user",
     *      description="Creates a new user.",
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="password", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *              @OA\Property(property="country", type="string", example="Spain"),
     *              @OA\Property(property="city", type="string", example="Barcelona"),
     *              @OA\Property(property="street", type="string", example="carrer lleo"),
     *              @OA\Property(property="floor", type="string", example="4"),
     *              @OA\Property(property="door", type="string", example="5"),
     *              @OA\Property(property="zipcode", type="string", example="08001")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="User created successfully. No token is returned.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="User created successfully.")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  example={
     *                      "name": {"The name field is required."},
     *                      "surname": {"The surname field is required."},
     *                      "email": {"The email must be unique."},
     *                  }
     *              )
     *          )
     *      )
     * )
     */
    public function store()
    {
    }
}
