<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sonucu</x-slot>

    <div class="card">
        <div class="card-body">

            <h3>Puan : <strong class="badge bg-primary rounded-pill">{{$quiz->my_result->point}}</strong></h3> 
            <!-- Aldığımız puan -->

            <div class="alert bg-warning">
                <i class="fa fa-check text-success"></i>Doğru <br>
                <i class="fa fa-times text-danger"></i>Yanlış<br>
                <i class="fa fa-times-circle-o"></i>İşaretlediğin Şık<br>

            </div>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <p class="card-text">

                @foreach($quiz->questions as $question)

                <small>
                    Katılımcılar
                    <strong>
                        % {{$question->true_percent}}
                    </strong>
                    oranında doğru cevap verdi!
                </small>
                <br>
                @if($question->correct_answer == $question->my_answer->answer)
                <!-- verdiğim cevap ile doğru cevap eşit ise -->
                <i class="fa fa-check text-success"></i>
                @else
                <i class="fa fa-times text-danger"></i>
                @endif
                <strong>#{{$loop->iteration}}</strong>
                {{$question->question}}
                @if($question->image)
                <img src="{{asset($question->image)}}" style="width: 30%;" class="img-responsive">
                @endif
            <div class="form-check mt-2">
                @if('answer1' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer1'==$question->my_answer->answer)
                <i class="fa fa-times-circle-o"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}1">
                    {{$question->answer1}}
                </label>
            </div>
            <div class="form-check">
                @if('answer2' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer2'==$question->my_answer->answer)
                <i class="fa fa-times-circle-o"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}2">
                    {{$question->answer2}}
                </label>
            </div>
            <div class="form-check">
                @if('answer3' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer3'==$question->my_answer->answer)
                <i class="fa fa-times-circle-o"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}3">
                    {{$question->answer3}}
                </label>
            </div>
            <div class="form-check">
                @if('answer4' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer4'==$question->my_answer->answer)
                <i class="fa fa-times-circle-o"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}4">
                    {{$question->answer4}}
                </label>
            </div>
            @if(!$loop->last)
            <hr>
            @endif
            @endforeach

            </p>
        </div>
    </div>
</x-app-layout>