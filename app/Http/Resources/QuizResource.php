<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'type' => $this->type,
            'text' => $this->question,
            'possibilities'=>[
                [
                    'answer'=>$this->option1
                ],
                [
                    'answer'=>$this->option2
                ],
                [
                    'answer'=>$this->option3
                ],
                [
                    'answer'=>$this->option4
                ],
            ],
            'selected' => null,
            'answer'=>$this->answer,
            'correct'=>null,
        ];
    }
}
