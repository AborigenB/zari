<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contact_info' => 'required|string|max:255',
            'question' => 'required|string',
        ]);

        Question::create($validatedData);

        return response()->json(['message' => 'Вопрос успешно отправлен'], 200);
    }
    public function accept($id)
    {
        $question = Question::findOrFail($id);
        $question->status = 'В процессе';
        $question->save();

        return response()->json(['message' => 'Вопрос успешно принят'], 200);
    }

    public function close($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Вопрос успешно закрыт'], 200);
    }
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Вопрос успешно удален'], 200);
    }

    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.index', compact('questions'));
    }
}
