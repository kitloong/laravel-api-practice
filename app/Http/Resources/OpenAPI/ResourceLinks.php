<?php

namespace App\Http\Resources\OpenAPI;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ResourceLinks",
 *     @OA\Property(property="first", type="string", description="First page link"),
 *     @OA\Property(property="last", type="string", description="Last page link"),
 *     @OA\Property(property="prev", type="string", nullable=true, description="Previous page link"),
 *     @OA\Property(property="next", type="string", nullable=true, description="Next page link"),
 * )
 */
class ResourceLinks {}
