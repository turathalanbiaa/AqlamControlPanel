<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function  deleteComment (Request $request)
    {
        $comment = Comment::findOrFail($request->delete);

        try {
            $comment->delete();
        } catch (\Exception $exception) {

            return 'حدث خطأ ما الرجاء ' . '<a href="/">الضغط هنا </a>' . 'للعودة للصفحة الرئيسية';
        }

        return redirect()->back()->with(['message' => 'تم حذف التعليق', 'type' => 'danger']);
    }

}
