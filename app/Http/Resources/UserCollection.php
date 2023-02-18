<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'User resource collection',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/User')
        ),
        new OA\Property(
            property: 'links',
            ref: '#/components/schemas/ResourceLinks'
        ),
        new OA\Property(
            property: 'meta',
            ref: '#/components/schemas/ResourceMeta'
        ),
    ]
)]
class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
