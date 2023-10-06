<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $unread_noti_count = auth()->user()->unreadNotifications()->count();
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'account_number' => $this->Wallet ? $this->Wallet->account_number :'',
            'amount' => $this->Wallet ? number_format($this->Wallet->amount) :0,
            'phone_qr_value' => $this->phone,
            'unread_noti_count' => $unread_noti_count,
        ];
    }
}
