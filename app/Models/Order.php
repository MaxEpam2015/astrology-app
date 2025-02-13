<?php

namespace App\Models;

use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

/**
 * @method static Order create(string[] $attributes = [])
 * @method static Order firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Order store(StoreRequest $storeRequest)
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
     * @var string[]
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

    public function scopeStore(Builder $builder, StoreRequest $storeRequest): string
    {
        $createdOrder = $builder->create([
            'name' => $storeRequest->name,
            'email' => $storeRequest->email,
            'astrologer_uuid' => $storeRequest->astrologer_uuid,
            'uuid' => Str::uuid(),
        ]);

        /** @var UuidInterface $orderUuid */
        $orderUuid = $createdOrder->uuid;

        return $orderUuid->toString();
    }
}
