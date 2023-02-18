<?php

namespace App\Http\Resources\OpenAPI;

use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(
            property: "first",
            description: "First page link",
            type: "string"
        ),
        new OA\Property(
            property: "last",
            description: "Last page link",
            type: "string"
        ),
        new OA\Property(
            property: "prev",
            description: "Previous page link",
            type: "string",
            nullable: true
        ),
        new OA\Property(
            property: "next",
            description: "Next page link",
            type: "string",
            nullable: true
        ),
    ]
)]
class ResourceLinks
{
}
