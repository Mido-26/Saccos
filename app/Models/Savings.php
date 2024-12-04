<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    /** @use HasFactory<\Database\Factories\SavingsFactory> */
    use HasFactory;

    protected $fillable = [
        'account_balance',
        'interest_earned',
        'last_deposit_date',
        'user_id',
    ];

    /**
     * Get the user that owns the savings.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
