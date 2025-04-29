<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Request $request, $id){
        $data = $request->validate([
            'title' => 'required|string|max:120',
            'description'=>'required|string|max:8500|min:30',
            'score*'=>'required|integer|min:1|max:10',
        ],[
            'score.required' => 'Пожалуйста, оцените произведение',
        ]);

        Review::create([
            'art_id'=>$id,
            'user_id'=>auth()->user()->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'score1' => $request->score[0],
            'score2' => $request->score[1],
            'score3' => $request->score[2],
            'score4' => $request->score[3],
            'score5' => $request->score[4],
            'score6' => $request->score[5],
        ]);

        return redirect()->back()->with('success', 'Рецензия успешно отправлена');
    }

    public function edit($id){
        $review = Review::find($id);
        return view('pages.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'title' => 'required|string|max:120',
            'description'=>'required|string|max:8500|min:30',
            'score*'=>'required|integer|min:1|max:10',
        ],[
            'score.required' => 'Пожалуйста, оцените произведение',
        ]);
        $review = Review::find($id);
        $review->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'score1' => $request->score[0],
            'score2' => $request->score[1],
            'score3' => $request->score[2],
            'score4' => $request->score[3],
            'score5' => $request->score[4],
            'score6' => $request->score[5],
        ]);
        return redirect()->back()->with('success', 'Рецензия успешно обновлена');
    }

    public function delete($id){
        $review = Review::find($id);
        $review->delete();
        return redirect()->back()->with('success', 'Рецензия успешно удалена');
    }
}
