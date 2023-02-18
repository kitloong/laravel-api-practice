<?php

namespace App\Http\Resources\OpenAPI;

use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(
            property: 'url',
            description: 'Page link',
            type: 'string'
        ),
        new OA\Property(
            property: 'label',
            description: 'Page label',
            type: 'string'
        ),
        new OA\Property(
            property: 'active',
            description: 'Current page flag',
            type: 'boolean'
        ),
    ]
)]
class ResourceMetaLinks
{
}
