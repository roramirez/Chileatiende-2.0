<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $casts = [
        'published' => 'boolean'
    ];

    protected $attributes = [
        'published' => true,
        'template' => 'general'
    ];

    public function scopePublished($query)
    {
        return $query->wherePublished(1)->whereState(1);
    }

    public function getUpdatedForHumanAttribute($value)
    {
        return Carbon::parse($this->getAttribute('updated_at'))->formatLocalized('%d de %B, %Y');
    }
}
