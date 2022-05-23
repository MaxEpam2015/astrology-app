<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Astrologer extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'astrologer_service',
            'astrologer_uuid',
            'service_uuid',
            'uuid',
            'uuid',
        );
    }
}
