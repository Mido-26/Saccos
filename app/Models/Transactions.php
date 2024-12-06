<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionsFactory> */
    use HasFactory;

    protected $guarded= [];
    public function user()
    {
            return $this->belongsTo(User::class);
         }
    public static function generateTransactionReference()
    {
            return 'TX-' . strtoupper(uniqid()) . '-' . now()->timestamp;
        }

        public function initiator()
        {
                return $this->belongsTo(User::class);
             }  
             
}
