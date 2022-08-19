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
}
