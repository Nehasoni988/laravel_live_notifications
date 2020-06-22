<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $casts = ['toppings' => 'array'];
    protected $appends = ['status_string','size_string'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getStatusStringAttribute() {
        return STATUS_STRING[$this->status];
    }

    public function getSizeStringAttribute() {
        return SIZES_STRING[$this->size];
    }
}
