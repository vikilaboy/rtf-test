<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use HasTimestamps;
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'priority'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static array $priorities = [
        1,
        2,
        3,
        4,
        5,
    ];
}
