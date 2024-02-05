<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'receiver_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public static function createNotification(string $message, Collection $users): void
    {
        foreach ($users as $user) {
            self::create([
                'message' => $message,
                'receiver_id' => $user->id,
            ]);
        }
    }
}
