<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    protected $fillable = [
        'title',
        'body',
        'activity_id',
        'user_id',
    ];
}
