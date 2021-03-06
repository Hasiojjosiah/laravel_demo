<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','task','date'];
    protected $casts = [
        'task' => 'string',
        'date' => 'date',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
