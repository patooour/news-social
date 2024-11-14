<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  [
            'username' =>$this->username,
            'user_status' =>$this->status(),
            'user_date' =>$this->created_at->diffForHumans(),
        ];
        if (request()->is('api/account/user')){

            $data['id'] = $this->id;
            $data['email'] = $this->email;
            $data['name'] = $this->name;
            $data['phone'] = $this->phone;
            $data['country'] = $this->country;
            $data['city'] = $this->city;
            $data['street'] = $this->street;
            $data['image'] = asset($this->image);
        }
        return $data;
    }
}
