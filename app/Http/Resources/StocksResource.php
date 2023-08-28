<?php

namespace App\Http\Resources;

use App\Models\Value;
use App\Models\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

class StocksResource extends JsonResource
{
    public function toArray($request)
    {
        $result = [
            'quantity' => $this->quantity
        ];

        return $this->getAttributes($result);

    }


    public function getAttributes($result){

        $attributes = json_decode($this->attributes);
        foreach($attributes as $stockAttribute){
            $attribute = Attribute::find($stockAttribute->attribute_id);
            $value = Value::find($stockAttribute->value_id);
            $result[$attribute->name] = $value->getTranslations('name');
        }
        return $result;
    }
}
