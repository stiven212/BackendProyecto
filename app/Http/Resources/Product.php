<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'price' => $this->price,
            'sale' => $this->sale,
            'image1' => $this->image1,
            'image2' => $this->image2,
            'image3' => $this->image3,
            'image4' => $this->image4,
            'image5' => $this->image5,
            'created_at' => $this->created_at,
            'updated_at' => $this-> updated_at,
            'category' => "/api/categories/". $this->category_id,
            'product' => "/api/categories/". $this->category_id .'/products/'. $this->id,

        ];    }
}
