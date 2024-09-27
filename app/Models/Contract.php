<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ContractCreate;
use App\Models\Scopes\ContractScope;

class Contract extends Model
{
    use HasFactory, HasUuids, Notifiable;

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'created' => ContractCreate::class,
    ];
    protected static function booted(): void
    {
        static::addGlobalScope(new ContractScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
