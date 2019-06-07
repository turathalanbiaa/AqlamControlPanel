<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\TrashArticle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
use App\Enum\ArticleStatus;

class ArticleController extends Controller
{
    public function main () {
        $categories = Category::all();
        return view('main', ['categories' => $categories]);
    }

    public function dataTable () {
        $articles = Article::with('category')
            ->select('id','title','created_at','category_id','views', 'status');

        return DataTables::eloquent($articles)
            ->addColumn('categoryName', function ($articles) {
                return $articles->category->name;
            })
            ->addColumn('statusColumn', function ($articles) {
                 switch ($articles->status) {
                     case ArticleStatus::ACCEPT; return '<span style="color: lightgreen">مقبولة</span>';
                     case ArticleStatus::REJECT; return '<span style="color: red">مرفوضة</span>';
                     case ArticleStatus::OUTSTANDING; return '<span style="color: goldenrod">معلقة</span>';
                 }

                 return '';
            })
            ->addColumn('titleLink', function ($articles){
                return '<a href="'.route('viewArticle', $articles->id).'">'.$articles->title.'</a>';
            })
            ->rawColumns(['titleLink', 'statusColumn'])
            ->make(true);
    }

    public function dataTableFilter(Request $request) {
        $articles = Article::with('category')
            ->select('id','title','created_at','category_id','views', 'status');

        return DataTables::eloquent($articles)->filter(function ($query) use ($request) {
            if ($request->has('created_at')) {
                $query->where('created_at', '>', date($request->get('created_at')));
            }
            if ($request->get('inputStatus') !=4) {
                $query->where('status', $request->get('inputStatus'));
            }
            if ($request->get('category') != 0) {
                $query->where('category_id', $request->get('category'));
            }


        })
            ->addColumn('categoryName', function ($articles) {
                return $articles->category->name;
            })
            ->addColumn('statusColumn', function ($articles) {
                switch ($articles->status) {
                    case ArticleStatus::ACCEPT; return '<span style="color: lightgreen">مقبولة</span>';
                    case ArticleStatus::REJECT; return '<span style="color: red">مرفوضة</span>';
                    case ArticleStatus::OUTSTANDING; return '<span style="color: goldenrod">معلقة</span>';
                }

                return '';
            })
            ->addColumn('titleLink', function ($articles){
                return '<a href="'.route('viewArticle', $articles->id).'">'.$articles->title.'</a>';
            })
            ->rawColumns(['titleLink', 'statusColumn'])
            ->make(true);
    }

    public function viewArticle ($id) {
        $article =Article::with('user', 'category', 'comment')->findOrfail($id);

        return view('viewArticle', ['article' => $article]);
    }

    public function deleteArticle (Request $request) {

        $article = Article::with('comment')->findOrFail($request->delete);
        $trashArticle = new TrashArticle();
        $trashArticle->title       = $article->title;
        $trashArticle->user_id     = $article->user_id;
        $trashArticle->content     = $article->content;
        $trashArticle->created_at  = $article->created_at;
        $trashArticle->category_id = 1;
        $trashArticle->views       = $article->views;
        $trashArticle->tags        = $article->tags;
        $trashArticle->status      = $article->status;
        $trashArticle->image       = $article->image;
        $trashArticle->rate        = $article->rate;

        try {
           $trashArticle->save();
           $article->delete();
        }
        catch (\Exception $e) {
            return 'حدث خطأ ما الرجاء '.'<a href="/">الضغط هنا </a>'.'للعودة للصفحة الرئيسية';
        }

        return redirect()->route('main')->with(['message' => 'تم حذف التوينة', 'type' => 'danger']);
    }

    public function acceptArticle ($id) {
        Article::findOrFail($id)->update(['updated_status' => Carbon::now(), 'status' => 1]);

        return redirect()->back()->with(['message' => 'تم قبول التدوينة', 'type' => 'success']);

    }

    public function rejectArticle ($id) {
        Article::findOrFail($id)->update(['status' => 2]);


        return redirect()->back()->with(['message' => 'تم رفض التوينة', 'type' => 'danger']);

    }

    public function editArticle ($id) {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('editArticle', ['article' => $article, 'categories' => $categories]);
    }

    public function  updateArticle (Request $request) {
        $this->validate($request, array(
            'title' => 'required',
            'contentText' => 'required',
            'categoryID' => 'required'
        ));

        $article =Article::findOrFail($request->articleID);
        $article->title = $request->title;
        $article->content = $request->contentText;
        $article->category_id = $request->categoryID;
        $article->update();

        return redirect()->route('viewArticle', $request->articleID)
            ->with(['message' => 'تم تعديل التدوينة', 'type' => 'success']);

    }

    public function viewTrashArticles () {
        $articles = TrashArticle::with('user', 'category')->paginate(20);

        return view('viewTrashArticles', ['articles' => $articles]);
    }

    public function returnTrashArticle (Request $request) {

        $trashArticle = TrashArticle::findOrFail($request->articleID);

        $article = new Article();
        $article->title       = $trashArticle->title;
        $article->user_id     = $trashArticle->user_id;
        $article->content     = $trashArticle->content;
        $article->created_at  = $trashArticle->created_at;
        $article->category_id = $trashArticle->category_id;
        $article->views       = $trashArticle->views;
        $article->tags        = $trashArticle->tags;
        $article->status      = $trashArticle->status;
        $article->image       = $trashArticle->image;
        $article->rate        = $trashArticle->rate;

        try {
            $article->save();
            $trashArticle->delete();
        }
        catch (\Exception $e) {

            return 'حدث خطأ ما الرجاء '.'<a href="/">الضغط هنا </a>'.'للعودة للصفحة الرئيسية';
        }

        return redirect()->route('viewTrashArticles')->with(['message' => 'تم ارجاع التوينة', 'type' => 'success']);
    }

    public  function backup ()
    {

        try {
            Artisan::call('backup:run --only-db');
        } catch (\Exception $exception) {

            return 'حدث خطأ ما الرجاء '.'<a href="/">الضغط هنا </a>'.'للعودة للصفحة الرئيسية';
        }

        return redirect()->back()->with(['message' => 'تم انشاء نسخة احتياطية ', 'type' => 'success']);
    }


}
