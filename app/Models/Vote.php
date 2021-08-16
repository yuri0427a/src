<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Vote extends Model
{

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vote',
        'number',
        'question_id',
    ];

    protected $table = 'votes';

    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

}
