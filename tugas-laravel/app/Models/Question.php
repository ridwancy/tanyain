<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;

class Question extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['subject_id', 'body', 'photo', 'slug', 'user_id'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'body'
            ]
            ];
    }
}
