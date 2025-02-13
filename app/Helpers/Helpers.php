<?php


namespace App\Helpers;

use App\Models\User;

class Helpers
{
    public static function updateUserTotal(User $user)
    {
        $total = 0;
        foreach ($user->envelopes as $envelope) {
            $total += $envelope->total;
        }
        $user->total = $total;
        $user->save();
    }
}