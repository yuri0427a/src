<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'message',
    ];

    use SoftDeletes;

    // 論理削除
    protected $table = 'comments';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
