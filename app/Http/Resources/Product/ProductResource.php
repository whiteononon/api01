<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'name' => $this->name,
      'description' => $this->detail,
      'price' => $this->price,
      'stock' => $this->stock == 0 ? 'out of stock' : $this->stock,
      'discount' => $this->discount,
      'totalPrice' => round($this->price * (1 - ($this->discount / 100)), 2),
      'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'no rating yet',
      'herf' => [
        'reviews' => route('reviews.index', $this->id)
      ]

    ];
  }
}
