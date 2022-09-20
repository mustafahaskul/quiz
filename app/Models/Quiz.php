<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable=['title','description','status','finished_at','slug'];

    protected $dates=['finished_at']; // kendi oluşturduğumuz sütunu carbon olarak kullanabilmek için burada belirtiyoruz

    public function getFinishedAtAttribute($date) 
    { 
        return $date ? Carbon::parse($date): null; // ilgili sütunda biyiş tarihi varsa caerbon bize parse sayesinde kullanılabilir bir fonksiyon halinde dönecek
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
