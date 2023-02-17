<?php

namespace App\Http\Resources\OpenAPI;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ResourceMeta",
 *     @OA\Property(property="current_page", type="integer", description="Current page number"),
 *     @OA\Property(property="from", type="integer", description="Number of first item from current page"),
 *     @OA\Property(property="last_page", type="integer", description="Last page number"),
 *     @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/ResourceMetaLinks")),
 *     @OA\Property(property="path", type="string", description="Base URL"),
 *     @OA\Property(property="per_page", type="integer", description="Number of item per page"),
 *     @OA\Property(property="to", type="integer", description="Number of last item from current page"),
 *     @OA\Property(property="total", type="integer", description="Total count of all items"),
 * )
 */
class ResourceMeta{}
