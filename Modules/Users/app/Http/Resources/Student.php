<?php

namespace Modules\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'courses' => $this->courses,
//            'notifications' => $this->messages,
//            'num_messages' => $this->getNumUnreadMessages($this->messages),
            'language' =>  $this->language,
            'phone_number' => $this->phone_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'email_verified_at' => $this->email_verified_at,
            'activated_at' => $this->activated_at,
        ];
    }

    function getNumUnreadMessages($messages)
    {
        if($messages)
        {
            return $messages->whereNull('read_at')->count();

        }
        return 0;

    }

}
