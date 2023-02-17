<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2021/05/23
 */

namespace App\Http\Resources\OpenAPI;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ResourceMetaLinks",
 *     @OA\Property(property="url", type="string", description="Page link"),
 *     @OA\Property(property="label", type="string", description="Page label"),
 *     @OA\Property(property="active", type="boolean", description="Current page flag"),
 * )
 */
class ResourceMetaLinks{}
