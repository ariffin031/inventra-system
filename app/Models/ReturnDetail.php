<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnDetail extends Model
{
    protected $fillable = [
        'return_id',
        'borrowing_detail_id',
        'physical_condition',
        'notes',
    ];

    public function toolReturn(): BelongsTo
    {
        return $this->belongsTo(ToolReturn::class, 'return_id');
    }

    public function borrowingDetail(): BelongsTo
    {
        return $this->belongsTo(BorrowingDetail::class);
    }
}
