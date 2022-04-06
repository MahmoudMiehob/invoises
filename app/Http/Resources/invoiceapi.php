<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class invoiceapi extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'num' => $this->invoice_number,
        ];
    }
}
