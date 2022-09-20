<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $appends=[
        'true_percent'
    ];
    public function getTruePercentAttribute(){
        $answer_count= $this->answers()->count(); // cevap sayısı
        $true_answer = $this->answers()->where('answer',$this->correct_answer)->count(); // tüm cevaplara ulaş. doğru olan cevapların sayısını getir
        return round((100/$answer_count) * $true_answer); // doğru cevap verenlerin yüzdesi
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }

    public function my_answer(){
        return $this->hasOne('App\Models\Answer')->where('user_id',auth()->user()->id); // cevapların içinden benim user_id ile eşleşen cevapları getir
    }
    protected $fillable=['question','answer1','answer2','answer3','answer4','correct_answer','image'];

}
