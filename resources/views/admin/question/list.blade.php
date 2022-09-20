<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Quizine ait sorular</x-slot><!-- Seçilen quizin başlığını yazar -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Soru Oluştur</a>
            </h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Soru</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1. Cevap</th>
                        <th scope="col">1. Cevap</th>
                        <th scope="col">2. Cevap</th>
                        <th scope="col">4. Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col" style="width: 80px;">İşlemler</th>
                    </tr>
                    <?php foreach ($quiz->questions as $question) { ?>
                        <!-- quiz tablosundaki questionları döndür -->
                        <tr>
                            <td>{{$question->question}}</td>
                            <td>
                                {{$question->image}}
                                <!-- @if($question->image)
                                <a href="{{asset($question->image)}}" target="_blank" class="btn btn-sm btn-light">Görüntüle</a>
                                @endif -->
                            </td>
                            <td>{{$question->answer1}}</td>
                            <td>{{$question->answer2}}</td>
                            <td>{{$question->answer3}}</td>
                            <td>{{$question->answer4}}</td>
                            <td class="text-success">
                                {{substr($question->correct_answer, -1)}}. Cevap
                                <!-- substr = sondan ... karakteri al -->
                            </td>
                            <td>
                                <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('quizzes.destroy',$quiz->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                            <!-- <td>
                                <a href="{{route('questions.edit',[$quiz->id,$question->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('questions.destroy',[$quiz->id,$question->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td> -->
                        </tr>
                    <?php } ?>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>