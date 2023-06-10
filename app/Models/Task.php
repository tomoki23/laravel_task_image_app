<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assigned_user_id',
        'category_id',
        'title',
        'image_path',
        'body',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class);
    }

    protected function status(): Attribute
    {
        $statusLabels = config('status.statusLabels');
        return Attribute::make(
            get: fn (string $status) => $statusLabels[$status],
            set: fn () => strval(array_keys($statusLabels)[2])
        );
    }
}
