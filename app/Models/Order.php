<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @method static Order create(array $attributes = [])
 * @method static Order firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 *
 * @property string $uuid
 * @property string $email
 * @property string $name
 * @property Astrologer $astrologer
 */
class Order extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'astrologer_uuid',
        'uuid',
    ];

    public function astrologer(): BelongsTo
    {
        return $this->belongsTo(Astrologer::class, 'astrologer_uuid', 'uuid');
    }
}
