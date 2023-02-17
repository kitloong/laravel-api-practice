<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     description="User model",
 *     @OA\Property(property="id", type="integer", description="ID"),
 *     @OA\Property(property="name", type="string", description="Name"),
 *     @OA\Property(property="email", type="string", description="Email"),
 *     @OA\Property(property="email_verified_at", type="string", nullable=true, description="Account verified timestamp"),
 *     @OA\Property(property="created_at", type="string", nullable=true, description="Created timestamp"),
 *     @OA\Property(property="updated_at", type="string", nullable=true, description="Updated timestamp"),
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
