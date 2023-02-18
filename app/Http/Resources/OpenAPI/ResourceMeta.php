<?php

namespace App\Http\Resources\OpenAPI;

use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(
            property: "current_page",
            description: "Current page number",
            type: "integer"
        ),
        new OA\Property(
            property: "from",
            description: "Number of first item from current page",
            type: "integer"
        ),
        new OA\Property(
            property: "last_page",
            description: "Last page number",
            type: "integer"
        ),
        new OA\Property(
            property: "links",
            type: "array",
            items: new OA\Items(ref: "#/components/schemas/ResourceMetaLinks")
        ),
        new OA\Property(
            property: "path",
            description: "Base URL",
            type: "string"
        ),
        new OA\Property(
            property: "per_page",
            description: "Number of item per page",
            type: "integer"
        ),
        new OA\Property(
            property: "to",
            description: "Number of last item from current page",
            type: "integer"
        ),
        new OA\Property(
            property: "total",
            description: "Total count of all items",
            type: "integer"
        ),
    ]
)]
class ResourceMeta
{
}
