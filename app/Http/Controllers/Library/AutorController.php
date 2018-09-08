<?php

namespace App\Http\Controllers\Library;

use App\Model\Library\Autor;
use App\Model\Library\Books;
use App\Model\Library\Genres;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutorController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$books = Books::with( 'genre' )
	                    ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre', DB::raw('COUNT(*) as products_count'))
	                    ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
	                    ->join('genres', 'books.genre','=','genres.idgenre')
	                    ->havingRaw('COUNT(*) > 1')
		                ->paginate(8);

		$autors =Books::select('strAutor', DB::raw('COUNT(*) '))
						 ->groupBy( 'strAutor')
						 ->havingRaw('COUNT(*) > 1')
						 ->get();

		 return view('Library.autors', ['books'=>$books], ['autors'=>$autors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function showAutorBooks(Request $request)
    {
			$nameAutor = $request->nameAutor;
//			echo $nameAutor;

        $books = Books::with('genre')
            ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre', DB::raw('COUNT(*) as products_count'))
            ->where( 'books.strAutor', $nameAutor, DB::raw('COUNT(*) as products_count'))
            ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
            ->join('genres', 'books.genre','=','genres.idgenre')
            ->havingRaw('COUNT(*) > 1')
            ->paginate(8);

        $autors =Books::select('strAutor', DB::raw('COUNT(*) '))
						 ->groupBy( 'strAutor')
						 ->havingRaw('COUNT(*) > 1')
						 ->get();

        return view('Library.autors', ['books'=>$books], ['autors'=>$autors]);
    }

		/**
		 * Display the specified resource.
         *
		 * @param  \Illuminate\Http\Request  $request
         *
         * @return \Illuminate\Http\Response
         *
		 */
	public function showAutorBook(Request $request)
	{
        $nameBook = $request->nameBook;
        $nameAutor = $request->nameAutor;
//        echo '/ ',$nameAutor, '/ ', $nameBook ;

        $book = Books::with('genre')
            ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre', DB::raw('COUNT(*) as products_count'))
            ->where( 'books.name', $nameBook, DB::raw('COUNT(*) as products_count'))
            ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
            ->join('genres', 'books.genre','=','genres.idgenre')
            ->havingRaw('COUNT(*) > 1')
            ->paginate(8);


		$autors =Books::select('strAutor', DB::raw('COUNT(*) '))
										 ->groupBy( 'strAutor')
										 ->havingRaw('COUNT(*) > 1')
										 ->get();

		return view('Library.autorBook', ['book'=>$book], ['autors'=>$autors]);
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
     * Display the specified resource.
     *
     * @param  \App\Model\Library\Autor  $autor
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function show(Autor $autor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Library\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Library\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autor $autor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Library\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        //
    }
}
