<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'age',
        'breed_id',
    ];


    /**
     * Порода кошки
     * @return BelongsTo
     */
    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

}
