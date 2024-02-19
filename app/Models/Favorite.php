<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // Indica los atributos que pueden asignarse masivamente
    protected $fillable = ['user_id', 'favoritable_id', 'favoritable_type', 'title', 'image_url', 'description', 'additional_info'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritable()
    {
        return $this->morphTo();
    }

}
