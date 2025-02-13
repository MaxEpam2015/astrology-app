<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static Order firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Astrologer list()
 * @method static Astrologer show(string $uuid)
 *
 * @property string $name
 */
class Astrologer extends Model
{
    use HasFactory;
    private string $servicesShowColumns = 'name,price';
    private const PER_PAGE = 3;

    /**
     * @var array|string[]
     */
    private array $hiddenAstrologersColumns = ['biography', 'email', 'uuid'];
    private string $servicesIndexColumns = 'name';

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

    public function scopeList(Builder $builder): CursorPaginator
    {
        $astrologers = $builder->with(['services:' . $this->servicesIndexColumns])->cursorPaginate(self::PER_PAGE);
        $astrologers->setCollection($astrologers->getCollection()->makeHidden($this->hiddenAstrologersColumns));

        return $astrologers;
    }

    public function scopeShow(Builder $builder, string $uuid): Astrologer
    {
        $astrologer = $builder->where('uuid', $uuid)->with(['services:' . $this->servicesShowColumns])->firstOrFail();
        unset($astrologer->uuid);

        return $astrologer;
    }
}
