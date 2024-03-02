<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    
    /**
     * Get the Category associated with the user.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'user_id','category_id','expense', 'amount', 'date'
    ];
}
