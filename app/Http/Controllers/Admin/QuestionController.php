<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request,$id)
    {
        if($request->hasFile('image')){   //bu bir resim mi değil mi?
            $fileName = Str::slug($request->question).'.'.$request->image->extension(); // resmin adı
            $fileNameWithUpload = 'uploads/'.$fileName; // resmin dosya yolu
            $request->image->move(public_path('uploads'),$fileName); // projenin içine kaydetme
            $request->merge([
                'image'=>$fileNameWithUpload  // $fileNameWithUpload  yerine image ekle
            ]);
        }
        Quiz::find($id)->questions()->create($request->post()); // $id üzerinden quizii bulma soruları listeleme soru ekleme
        return redirect()->route('questions.index',$id)->withSuccess('Soru Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id,$id)
    {
       return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id,$question_id)
    {
        $question =  Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Quiz ve ya soru bulunamadı');
        return view('admin.question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request,$quiz_id,$question_id)
    {
        if($request->hasFile('image'))//bu bir resim mi değil mi?
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();// resmin adı

            $fileNameWithUpload = 'uploads/'.$fileName;// resmin dosya yolu
            
            $request->image->move(public_path('uploads'),$fileName);// projenin içine kaydetme

            $request->merge([

                'image'=>$fileNameWithUpload// $fileNameWithUpload  yerine image ekle

            ]);

        }
         Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post());
          // verilen quiz var mı yok mu? varsa soruların içindeki hangi soru? o soruyu çek ve güncelle

        return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Başarıyla Güncellendi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id,$question_id)
    {
        Quiz::find($quiz_id)->questions()->whereId($question_id)->delete(); // böyle bir quiz var mı? varsa içineki sorulara ulaş. Hangi soruyu seçtiyse onu çek ve sil
        return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Başarıyla Silindi');
    }
}
