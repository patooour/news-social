<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site_name'=>$this->site_name,
            'favicon'=>asset($this->favicon),
            'logo'=>asset($this->logo),
            'facebook'=>$this->facebook,
            'youtube'=>$this->youtube,
            'instagram'=>$this->instagram,
            'twitter'=>$this->twitter,
            'Address'=>$this->street .' , '. $this->city .' , '. $this->country ,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'small_desc'=>$this->small_desc,
            'date'=>$this->created_at,

        ];
    }
}
