<?php

namespace App\Http\Resources;

use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin payment */
class paymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'status' => $this->status,
            'method' => $this->method,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'appointment_id' => $this->appointment_id,
        ];
    }
}
