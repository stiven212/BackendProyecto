<?php

namespace App\Http\Resources;

use App\Models\BuyDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this-> updated_at,
            'user_id' => $this->user_id,
            'details' => $this->details

        ];
    }
}
