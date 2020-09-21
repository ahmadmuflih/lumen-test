<?php
/**
 * Created by PhpStorm.
 * User: baso
 * Date: 2020-08-04
 * Time: 10:06
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'fullname' => $this->fullname,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}