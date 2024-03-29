<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];

    /**
     * Get the Category associated with the user.
     */
    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }
}
