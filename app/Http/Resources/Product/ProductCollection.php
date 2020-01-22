<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends Resource
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'name' => $this->name,
      'totalPrice' => round($this->price * (1 - ($this->discount / 100)), 2),
      'discount' => $this->discount,
      'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'no rating yet',
      'herf' => [
        'link' => route('products.show', $this->id)
      ]
    ];
  }
}
