<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
class Quiz extends Model
{
    use HasFactory;
    
    protected $fillable=['title','description','status','finished_at','slug'];

    protected $dates=['finished_at']; // kendi oluşturduğumuz sütunu carbon olarak kullanabilmek için burada belirtiyoruz
    protected $appends = ['details','my_rank'];

    public function getDetailsAttribute(){
        if($this->results()->count()>0){ // eğer katılımcı 0 dan büyükse
            return [
                'average'=>round($this->results()->avg('point')), // results fonksiyonunu çağırıp point sütununun ortalamasını aldı. round ile yuvarladı
                'join_count'=>$this->results()->count()//katılımcı sayısını verir
            ];
        }
        // katılımcı sayısı < 1 ise null döndür
            return null;
    }
    public function getMyRankAttribute(){
        $rank = 0;
        foreach($this->results()->orderByDesc('point')->get() as $result){  
            $rank += 1; // == $rank = $rank + 1;
            if(auth()->user()->id == $result->user_id){ // benim üye id ile result içindeki üye id eşit olduğunda
                return $rank;
            }
        }
    }
    public function topTen(){
        return $this->results()->orderByDesc('point')->take(10); // En yüksekten düşüğe doğru 10 tane sırala
    }

    public function results(){
        return $this->hasMany('App\Models\Result');
    }
    public function my_result(){
        return $this->hasOne('App\Models\Result')->where('user_id',auth()->user()->id);
    }
    public function getFinishedAtAttribute($date) 
    { 
        return $date ? Carbon::parse($date): null; // ilgili sütunda biyiş tarihi varsa caerbon bize parse sayesinde kullanılabilir bir fonksiyon halinde dönecek
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
