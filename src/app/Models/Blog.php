<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearchBlog($query, $search)
    {
        if(!is_null($search->userName) && !is_null($search->title)){
            return $query->where('title', 'LIKE', "%{$search->title}%")->with('user')->whereHas('user', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search->userName}%");
            });
        } else if(!is_null($search->userName)) {
            return $query->with('user')->whereHas('user', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search->userName}%");
            });
        } else if(!is_null($search->title)) {
            return $query->where('title', 'LIKE', "%{$search->title}%")->with('user');
        } else {
            return $query->with('user');
        }
    }
}
