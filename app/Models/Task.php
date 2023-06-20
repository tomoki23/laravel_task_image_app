<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

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
            set: fn (string $status) => $status === '' ? strval(array_keys($statusLabels)[2]) : $status
        );
    }

    public static function searchTask(Request $request): Collection
    {
        $tasks = Task::when($request->keyword, function (Builder $query, $keyword) {
            $query->where(function (Builder $query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('body', 'like', '%' . $keyword . '%');
            });
        })->when($request->user_id, function (Builder $query, $userId) {
            $query->where('user_id', '=', $userId);
        })->when($request->category_id, function (Builder $query, $categoryId) {
            $query->where('category_id', '=', $categoryId);
        })->when($request->status, function (Builder $query, $status) {
            $query->where('status', '=', $status);
        })->with('user', 'category')->get();

        return $tasks;
    }
}
