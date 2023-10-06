<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $title = '';
        if($this->type == 1){
            $title = 'From'.$this->Source->name;
        }else if($this->type == 2){
            $title = 'To'.$this->Source->name;
        }
        return [
            'trx_no' => $this->trx_no,
            'amount' => number_format($this->amount,2) .' MMK',
            'type' => $this->type,
            'title' => $title,
            'date' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
