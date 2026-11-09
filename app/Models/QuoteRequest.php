<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'services' => 'array',
            'assets' => 'array',
            'communication' => 'array',
            'attachments' => 'array',
            'agree_contact' => 'boolean',
            'agree_privacy' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }

    /** Services are stored as "category:Label" — return just the labels. */
    public function serviceLabels(): array
    {
        return collect($this->services ?? [])
            ->map(fn ($s) => str_contains($s, ':') ? explode(':', $s, 2)[1] : $s)
            ->all();
    }
}
