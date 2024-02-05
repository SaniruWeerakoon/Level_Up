<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Course extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'courses';
    protected $fillable = [
        'title',
        'description',
        'subject',
        'difficulty',
        'price',
        'author_id',
        'type',
        'content',
        'estimated_length',
        'course_image_path',
        'ratings',
        'completed_by',
        'hidden',
    ];

    public static function getTotalCourses(): int
    {
        return self::count();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function tutorial(): HasMany
    {
        return $this->hasMany(Tutorial::class);
    }

}
