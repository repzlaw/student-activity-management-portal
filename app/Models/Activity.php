<?php

namespace App\Models;

use Filament\Forms;
use App\Enums\Statuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'status',
        'provider',
        'start_date',
        'end_date',
        'hours',
        'approve_date',
        'approver_comment',
        'approver_id',
        'user_id',
        'team_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'approve_date' => 'datetime',
        'approver_id' => 'integer',
        'user_id' => 'integer',
        'team_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ActivityAttachment::class);
    }

    public function task(): MorphOne
    {
        return $this->morphOne(Task::class, 'modelable');
    }

}
