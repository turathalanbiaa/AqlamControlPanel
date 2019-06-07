<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Enum\CategoryDeleteType;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function viewAll () {
        $categories = Category::all();

        return view('viewAllCategories', ['categories' => $categories]);
    }

    public function update (Request $request) {
        $category = Category::findOrFail($request->categoryID);
        $category->name = $request->categoryName;
        $category->update();

        return redirect()->route('viewCategories')
            ->with(['message' => 'تم التعديل', 'type' => 'success']);
    }

    public function store (Request $request) {
        $category = new Category();
        $category->name = $request->categoryName;
        $category->save();

        return redirect()->route('viewCategories')
            ->with(['message' => 'تمت الاضافة', 'type' => 'success']);
    }

    public function delete (Request $request) {
        $category = Category::findOrFail($request->delete);
          if ($request->deleteCategory == CategoryDeleteType::DELETE_WITH_TRANSFER_ARTICLES) {
              $getCategoryID = $category->articles()->pluck('category_id');

              try {
                  $updateCategoryID = DB::table('posts')
                      ->whereIn('category_id', $getCategoryID)
                      ->update(array('category_id' => $request->categoryID));

                  return redirect()->route('viewCategories')
                      ->with(['message' => 'تم حذف الصنف مع نقل التدوينات الى صنف اخر', 'type' => 'danger']);
              } catch (\Exception $exception) {

                return 'حدث خطأ ما الرجاء '.'<a href="/">الضغط هنا </a>'.'للعودة للصفحة الرئيسية';
              }
          }

          try {
              $category->articles()->delete();
              $category->delete();

              return redirect()->route('viewCategories')
                  ->with(['message' => 'تم حذف الصنف مع التدوينات', 'type' => 'danger']);
          } catch (\Exception $exception) {
              return 'حدث خطأ ما الرجاء '.'<a href="/">الضغط هنا </a>'.'للعودة للصفحة الرئيسية';
          }
    }


}
