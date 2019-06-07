<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ArticleController@main')
    ->name('main')
    ->middleware('admin.login');
Route::get('/data-table', 'ArticleController@dataTable')
    ->name('dataTable')
    ->middleware('admin.login');

Route::post('/data-table-filter', 'ArticleController@dataTableFilter')
    ->name('dataTableFilter')
    ->middleware('admin.login');

Route::get('view-article/{id}', 'ArticleController@viewArticle')
    ->name('viewArticle')
    ->middleware('admin.login');

Route::post('delete-article', 'ArticleController@deleteArticle')
    ->name('deleteArticle')
    ->middleware('admin.login');

Route::get('accept-article/{id}', 'ArticleController@acceptArticle')
    ->name('acceptArticle')
    ->middleware('admin.login');

Route::get('reject-article/{id}', 'ArticleController@rejectArticle')
    ->name('rejectArticle')
    ->middleware('admin.login');

Route::get('edit-article/{id}', 'ArticleController@editArticle')
    ->name('editArticle')
    ->middleware('admin.login');
Route::post('update-article', 'ArticleController@updateArticle')
    ->name('updateArticle')
    ->middleware('admin.login');

Route::get('view-trash-articles', 'ArticleController@viewTrashArticles')
    ->name('viewTrashArticles')
    ->middleware('admin.login');

Route::post('return-trash-article', 'ArticleController@returnTrashArticle')
    ->name('returnTrashArticle')
    ->middleware('admin.login');

Route::get('backup', 'ArticleController@backup')
    ->name('backup')
    ->middleware('admin.login');

Route::post('delete-comment', 'CommentController@deleteComment')
    ->name('deleteComment')
    ->middleware('admin.login');

Route::get('categories/', 'CategoryController@viewAll')
    ->name('viewCategories')
    ->middleware('admin.login');

Route::post('categories/update', 'CategoryController@update')
    ->name('updateCategory')
    ->middleware('admin.login');

Route::post('categories/store', 'CategoryController@store')
    ->name('storeCategory')
    ->middleware('admin.login');

Route::post('categories/delete', 'CategoryController@delete')
    ->name('deleteCategory')
    ->middleware('admin.login');

Route::get('login-form', 'AdminController@loginForm')
    ->name('loginForm');

Route::post('login', 'AdminController@login')
    ->name('login');
