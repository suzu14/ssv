<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // start_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('group')->orderBy('start_at', 'DESC')->paginate($limit_count);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function user_start()
    {
        return $this->belongsTo(User::class, 'start_user_id');
    }
    
    public function user_end()
    {
        return $this->belongsTo(User::class, 'end_user_id');
    }
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    protected $fillable = [
        'group_id',
        'name',
        'comment',
        'status',
        'start_user_id',
        'end_user_id',
        'start_at',
        'end_at',
    ];
}
