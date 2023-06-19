<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];
    
    public function activities()   
    {
        return $this->hasMany(Activity::class);  
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function documents()   
    {
        return $this->hasMany(Document::class);  
    }
}
