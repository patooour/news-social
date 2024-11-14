<?php

namespace App\Http\Resources\RelatedNews;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RelatedNewsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
