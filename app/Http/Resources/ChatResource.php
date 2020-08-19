<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MessageResource;
class ChatResource extends JsonResource
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
            'senderID' => $this->sender->id,
            'receiverID' => $this->receiver->id,
            'otherEnd' => $this->otherEnd(),
            'messages' => MessageResource::collection($this->messages)
        ];
    }
}
