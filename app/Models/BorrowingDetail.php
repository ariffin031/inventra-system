<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BorrowingDetail extends Model
{
    protected $fillable = [
        'borrowing_id',
        'tool_unit_id',
        'notes',
    ];

    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function toolUnit(): BelongsTo
    {
        return $this->belongsTo(ToolUnit::class);
    }

    public function returnDetail(): HasOne
    {
        return $this->hasOne(ReturnDetail::class);
    }
}
