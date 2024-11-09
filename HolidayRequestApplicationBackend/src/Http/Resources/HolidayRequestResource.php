<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HolidayRequestResource extends JsonResource
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
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'email' => $this->user->email,
            ],
            'start_date' => $this->start_date->format('Y-m-d'),
            'end_date' => $this->end_date->format('Y-m-d'),
            'total_days' => $this->total_days,
            'status' => $this->status,
            'requested_at' => $this->requested_at->format('Y-m-d H:i:s'),
            'validated_at' => $this->validated_at ? $this->validated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
?>
