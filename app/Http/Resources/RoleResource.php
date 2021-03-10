<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="Role", title="Role")
 */

class RoleResource extends JsonResource
{
    /**
     * @OA\Property(
     *      property="id",
     *      type="integer"
     * ),
     * @OA\Property(
     *      property="user_id",
     *      type="integer"
     * ),
     * @OA\Property(
     *      property="status",
     *      type="string"
     * ),
     * @OA\Property(
     *      property="position",
     *      type="string"
     * )
     * 
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * 
     * uppressWarnings("unused")
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
