<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use	App\Books;
use	Illuminate\Http\Request;


/**
*	本のダッシュボード表示
*/

Route::get('/',	function	()	{
				$books	=	Books::orderBy('created_at',	'asc')->get();
				return	view('books',	[
								'books'	=>	$books
				]);
});




/**
	新「本」を追加
*/
Route::post('/books',	function	(Request	$request)	{

				//バリデーション
				$validator	=	Validator::make($request->all(),	[
							'item_name'	=>	'required|max:255',
							'item_number'	=>	'required|max:3',
							'item_amount'	=>	'required|max:5',
							'published'	=>	'required',
				]);
				//バリデーション：エラー
				if	($validator->fails())	{
						return	redirect('/')
								->withInput()
								->withErrors($validator);
				}
				// Eloquent モデル
			  $books =	new	Books;
				$books->item_name	=	$request->item_name;
				$books->item_number	=	$request->item_number;
				$books->item_amount	=	$request->item_amount;
				$books->published =	$request->published;
				$books->save();				//「/」ルートにリダイレクト
				return	redirect('/');
});

/**
*	本を削除
*/
Route::delete('/book/{book}',	function	(Books	$book)	{
				$book->delete();
				return	redirect('/');
});


/**
*	更新処理
*/
Route::post('/books/update',	function	(Request	$request)	{
				//バリデーション
				$validator	=	Validator::make($request->all(),	[
				  		//idがないと「特定」ができないので、必ず更新画面には必須　※追記
				  		'id' => 'required',
							'item_name'	=>	'required|max:255',
							'item_number'	=>	'required|max:3',
							'item_amount'	=>	'required|max:5',
							'published'	=>	'required',
				]);

				//バリデーション：エラー
				if	($validator->fails())	{
						return	redirect('/')
								->withInput()
								->withErrors($validator);
				}

				// Eloquent モデル
			  $books = Books::find($request->id);
				$books->item_name	=	$request->item_name;
				$books->item_number	=	$request->item_number;
				$books->item_amount	=	$request->item_amount;
				$books->published =	$request->published;
				$books->save();				//「/」ルートにリダイレクト
				return	redirect('/');
});


/**
*	更新画面


// <?php

// #Routing実行
// use App\Books; 
// use Illuminate\Http\Request; 


// /** * 本 のダッシュボード 表示 */ 
// Route::get('/', function () {
// 	 $books = Books::orderBy('created_at','asc')->get();
// 	 return view("books",['books'=>$books]);
// });

// /** * 新 「本」 を 追加 */ 
// Route::post('/books', function (Request $request) {
//     //バリデーション
//     $validator = Validator::make($request->all(), [
//             'id' => 'required',
//             'item_name' => 'required|max:255',
//             'item_number' => 'required|min:1|max:3',
//             'item_amount' => 'required|max:6',
//             'published'   => 'required',
//     ]);
//     //バリデーション:エラー
//     if ($validator->fails()) {
//             return redirect('/')
//                 ->withInput()
//                 ->withErrors($validator);
//     }
//       // Eloquent モデル
//     $books = new Books;
//     $books->item_name = $request->item_name;
//     $books->item_number = '1';
//     $books->item_amount = '1000';
//     $books->published = '2017-03-07 00:00:00';
//     $books->save();   //「/」ルートにリダイレクト 
//     return redirect('/');
// });

// //更新画面
// Route::post('/booksedit/{book}', function (Books $book) {
// 	 return view('booksedit', ['book' => $book]);
// });


// /** * 本 を 削除 */ 
// Route::delete('/book/{book}', function (Books $book) {
// 	 $book->delete();
// 	 return redirect('/');
// });



// /*
// |--------------------------------------------------------------------------
// | Application Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register all of the routes for an application.
// | It's a breeze. Simply tell Laravel the URIs it should respond to
// | and give it the controller to call when that URI is requested.
// |
// */

// // Route::get('/', function () {
// //     return view('welcome');
// // });
// //更新
// /** * 新 「本」 を 追加 */ 

// Route::post('/update', function (Request $request) {
//     //バリデーション
//     $validator = Validator::make($request->all(), [
//             'item_name' => 'required|max:255',
//     ]);
//     //バリデーション:エラー
//     if ($validator->fails()) {
//             return redirect('/')
//                 ->withInput()
//                 ->withErrors($validator);
//     }

//       // Eloquent モデル
//     $books = Books::find($request->id);
//     $books->item_name = $request->item_name;
//     $books->item_number = '1';
//     $books->item_amount = '1000';
//     $books->published = '2017-03-07 00:00:00';
//     $books->save();   //「/」ルートにリダイレクト 
//     return redirect('/');
//     });

// // Route::get('/gs/{a}', function ($a) {
// //     return 'ジーズアカデミー'.$a;
// // });

