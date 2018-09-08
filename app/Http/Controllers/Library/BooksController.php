<?php

namespace App\Http\Controllers\Library;


use App\Model\Library\Books;
use App\Model\Library\Genres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
	protected $bookAutor;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

    /**
     * Display a listing of the ALL library Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//	    'SELECT name, strAutor, Publishing, YearPublication, price, imageURL, description, genres.genre, count( * ) '
//	     'FROM books
//	     'INNER JOIN genres ON books.genre + 1 = genres.idgenre '
//	     'WHERE books.genre = '.$IDgenre.' '
//	     'GROUP BY name, strAutor, Publishing, YearPublication, price, imageURL, description, genres.genre '
//	     'HAVING count( * ) >1 ; '
//          ********************************************
	    $books = Books::with( 'genre' )
	                    ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre', DB::raw('COUNT(*) as products_count'))
	                    ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
	                    ->join('genres', 'books.genre','=','genres.idgenre')
	                    ->havingRaw('COUNT(*) > 1')
		                 ->paginate(8);
//	                    ->get();

	    $genre = Genres::all();

	    return view('Library.books', ['books'=>$books], ['genre'=>$genre]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display Books .
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showBook(Request $request)
    {
	    $nameBook = $request->nameBook;
	    $book = Books::with( 'genre' )
	                   ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
	                   ->where( 'books.name', $nameBook , DB::raw('COUNT(*) as products_count'))
	                   ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
	                   ->join('genres', 'books.genre','=','genres.idgenre')
	                   ->havingRaw('COUNT(*) > 1')
	                   ->get();

	    $genre = Genres::all();
	    return view('Library.book', ['book'=>$book], ['genre'=>$genre]);

    }

	/**
	 * Display Books .
	 *
	 * @param  $numGenre
     *
	 * @return \Illuminate\Http\Response
     *
	 */
	public function showBooksGenre( $numGenre )
	{
		$books = Books::with('genre')
		              ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre', DB::raw('COUNT(*) as products_count'))
		              ->where( 'books.genre', $numGenre, DB::raw('COUNT(*) as products_count'))
		              ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
		              ->join('genres', 'books.genre','=','genres.idgenre')
		              ->havingRaw('COUNT(*) > 1')
		              ->paginate(8);

		$genre = Genres::all();

		return view('Library.books', ['books'=>$books], ['genre'=>$genre]);
	}

	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Library\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Library\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Library\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $books)
    {
        //
    }

    /**
     * Тестовый метод для проверки работы модели
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function testmode() {
	    echo 'Echo OUT Public Function Testmode ' . '<br>';

//	    $books_t = Books::with( 'genre' )
//		    ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
//		    ->where( 'books.genre', 1 , DB::raw('COUNT(*) as products_count'))
//		    ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
//	        ->join('genres', 'books.genre','=','genres.idgenre')
//		    ->havingRaw('COUNT(*) > 1')
//	        ->get();
//	    foreach($books_t as $book){
//		    echo $book->name.',  ';
//		    echo $book->strAutor;
//		    echo $book->price.' грн,  ';
//		    echo $book->Weight.',  ';
//		    echo $book->genre.'  '.'<br>';
//	    }
//	    SELECT name, strAutor, Publishing, YearPublication, NumberPages, price, imageURL, description, genres.genre, count( * )
//	    FROM books
//	    INNER JOIN genres ON books.genre=genres.idgenre
//	    WHERE books.name = $nameBook
//	    GROUP BY name, strAutor, Publishing, YearPublication, NumberPages, price, imageURL, description, genres.genre'
//	    HAVING count( * ) >1

	    $books_t = Books::with( 'genre' )
		    ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
		    ->where( 'books.genre', 0 , DB::raw('COUNT(*) as products_count'))
		    ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
	        ->join('genres', 'books.genre','=','genres.idgenre')
		    ->havingRaw('COUNT(*) > 1')
	        ->get();
//	    $nameBook = 'Jane Eyrotica; Charlotte Bronte and Karena Rose';
//
//
//	    $books_t = Books::with( 'genre' )
//	                 ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
//	                 ->where( 'books.name', $nameBook , DB::raw('COUNT(*) as products_count'))
//	                 ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
//	                 ->join('genres', 'books.genre','=','genres.idgenre')
//	                 ->havingRaw('COUNT(*) > 1')
//	                 ->get();
//
	    foreach($books_t as $book){
		    echo $book->name.',  ';
		    echo $book->strAutor;
		    echo $book->price.' грн,  ';
		    echo $book->Weight.',  ';
		    echo $book->genre.'  '.'<br>';
	    }
    }
    /**
     *
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function about( ) {

	    $genre = Genres::all();

	    return view('Library.about', ['genre'=>$genre]);
    }

}
