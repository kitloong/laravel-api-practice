<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Attributes as OA;

#[OA\Schema(
    description: "User model",
    properties: [
        new OA\Property(
            property: "id",
            description: "ID",
            type: "integer"
        ),
        new OA\Property(
            property: "name",
            description: "Name",
            type: "string"
        ),
        new OA\Property(
            property: "email",
            description: "Email",
            type: "string"
        ),
        new OA\Property(
            property: "email_verified_at",
            description: "Account verified timestamp",
            type: "string",
            nullable: true
        ),
        new OA\Property(
            property: "created_at",
            description: "Created timestamp",
            type: "string",
            nullable: true
        ),
        new OA\Property(
            property: "updated_at",
            description: "Updated timestamp",
            type: "string",
            nullable: true
        ),
    ]
)]
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
