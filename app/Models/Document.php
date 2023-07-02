<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'group_id',
        'user_id',
        'name',
        'path',
        'status',
        'deadline',
    ];
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
