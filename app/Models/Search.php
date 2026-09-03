<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'is_new',
        'ip_hash',
    ];

    protected function casts(): array
    {
        return [
            'is_new' => 'boolean',
        ];
    }
}
