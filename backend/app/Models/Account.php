<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Account
 *
 * @property int $id
 * @property int $tariff_id
 * @property string $title
 * @property string $description
 *  */
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function subscribers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscribers');
    }

    public function listedAsTeacher(int $id): bool
    {
        return $this->subscribers()
            ->where('role', Role::TEACHER)
            ->where('user_id', $id)
            ->exists();
    }
}
