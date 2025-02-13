<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transaction extends Model
{
    protected $fillable = [ 'envelope_id', 'title', 'type', 'amount'];

    public function envelope(): BelongsTo
    {
        return $this->belongsTo(Envelope::class);
    }
}
