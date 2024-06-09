<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    protected $table = 'rental_items';
    protected $guarded = ['id'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    use HasFactory;
}
