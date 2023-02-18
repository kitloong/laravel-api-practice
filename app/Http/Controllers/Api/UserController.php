<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Users",
    description: "User API"
)]
class UserController extends Controller
{
    #[OA\Get(
        path: "/users",
        summary: "Display a listing of the users, with paginate.",
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(ref: "#/components/schemas/UserCollection")
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            )
        ]
    )]
    public function index(): JsonResponse
    {
        $users = User::paginate();
        return (new UserCollection($users))->response();
    }

    #[OA\Post(
        path: "/users",
        summary: "Store a newly created user in storage.",
        requestBody: new OA\RequestBody(
            description: "Input data",
            content: [
                new OA\MediaType(
                    mediaType: "application/x-www-form-urlencoded",
                    schema: new OA\Schema(
                        required: ["name", "email", "password"],
                        properties: [
                            new OA\Property(
                                property: "name",
                                description: "Name to be created",
                                type: "string",
                                maxLength: 255,
                            ),
                            new OA\Property(
                                property: "email",
                                description: "Email to be created",
                                type: "string",
                                maxLength: 255
                            ),
                            new OA\Property(
                                property: "password",
                                description: "Password to be created",
                                type: "string",
                                minLength: 8
                            )
                        ],
                        type: "object"
                    )
                )
            ]
        ),
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Successful operation",
                content: new OA\JsonContent(ref: "#/components/schemas/UserResource")
            ),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 422, description: "The given data was invalid"),
        ]
    )]
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'     => 'bail|required|string|max:255',
            'email'    => 'bail|required|string|max:255|email|unique:users,email',
            'password' => 'bail|required|string|min:8'
        ]);

        $user           = new User();
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Log::info("User ID $user->id created successfully.");

        return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    #[OA\Get(
        path: "/users/{id}",
        summary: "Display the specified user.",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: "integer"
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(ref: "#/components/schemas/UserResource")
            ),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 404, description: "Page not found"),
        ]
    )]
    public function show(User $user): JsonResponse
    {
        return (new UserResource($user))->response();
    }

    #[OA\Put(
        path: "/users/{id}",
        summary: "Update the specified user in storage.",
        requestBody: new OA\RequestBody(
            description: "Input data",
            content: [
                new OA\MediaType(
                    mediaType: "application/x-www-form-urlencoded",
                    schema: new OA\Schema(
                        required: ["name", "email", "password"],
                        properties: [
                            new OA\Property(
                                property: "name",
                                description: "Name to be created",
                                type: "string",
                                maxLength: 255,
                            ),
                            new OA\Property(
                                property: "email",
                                description: "Email to be created",
                                type: "string",
                                maxLength: 255
                            ),
                        ],
                        type: "object"
                    )
                )
            ]
        ),
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(ref: "#/components/schemas/UserResource")
            ),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 404, description: "Page not found"),
            new OA\Response(response: 422, description: "The given data was invalid"),
        ]
    )]
    public function update(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'name'  => 'bail|required|string|max:255',
            'email' => 'bail|required|string|max:255|email|unique:users,email,' . $user->id
        ]);

        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        Log::info("User ID {$user->id} updated successfully.");

        return (new UserResource($user))->response();
    }

    #[OA\Delete(
        path: "/users/{id}",
        summary: "Remove the specified user from storage.",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "Successful operation"
            ),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 404, description: "Page not found"),
        ]
    )]
    public function destroy(User $user): Response
    {
        $user->delete();

        Log::info("User ID {$user->id} deleted successfully.");

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
