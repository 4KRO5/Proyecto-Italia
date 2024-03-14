<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Lection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'instructor_id',
        'assistance',
        'date',
        'schedule',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id')->withTrashed();
    }    
}