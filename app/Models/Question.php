<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'contents',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vote()
    {
        return $this->hasMany(Vote::class, 'question_id');
    }


}
