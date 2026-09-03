<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_id',
        'author_name',
        'content',
        'reason',
        'ip_hash',
    ];

    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }
}
