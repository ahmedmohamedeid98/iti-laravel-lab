<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use Sluggable;
    use Sluggable;

    protected $fillable = ['title', 'description', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function image() {
        return $this->hasOne(Photo::class);
    }

    public function human_readable_date() {
        return Carbon::parse($this->attributes['created_at'])->isoFormat("dddd Do of MMMM YYYY h:mm:ss A");
    }

    

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
