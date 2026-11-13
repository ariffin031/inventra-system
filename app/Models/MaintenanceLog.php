<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceLog extends Model
{
    protected $fillable = [
        'tool_unit_id',
        'reported_by',
        'handled_by',
        'status',
        'description',
        'started_at',
        'completed_at',
        'repair_notes',
        'repair_cost',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'repair_cost' => 'decimal:2',
        ];
    }

    public function toolUnit(): BelongsTo
    {
        return $this->belongsTo(ToolUnit::class);
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
