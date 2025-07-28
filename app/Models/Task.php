<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Testing\Fluent\Concerns\Has;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'completed'];
    protected $casts = [
        'completed' => 'boolean',
    ];  
    public function scopeCompleted($query, $status = true)
    {
        return $query->where('completed', $status);
    }
    
}
