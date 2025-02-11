<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [ 'envelope_id', 'title', 'type', 'amount'];

    public function envelope(): BelongsTo
    {
        return $this->belongsTo(Envelope::class);
    }
}
