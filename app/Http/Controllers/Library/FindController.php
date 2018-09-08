<?php

namespace App\Http\Controllers\Library;

use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Library\Books;
use App\Model\Library\Genres;
use Illuminate\Support\Facades\DB;

class FindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//          ********************************************
        $books = Books::with( 'genre' )
            ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre', DB::raw('COUNT(*) as products_count'))
            ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
            ->join('genres', 'books.genre','=','genres.idgenre')
            ->havingRaw('COUNT(*) > 1')
            ->paginate(8);
//	                    ->get();

        $minage = Books::with( 'genre' )
//            ->select('YearPublication')
            ->min('YearPublication');
        $maxage = Books::with( 'genre' )
//            ->select('YearPublication')
            ->max('YearPublication');
        $pricemin = Books::with( 'genre' )
//            ->select('price')
            ->min('price');
        $pricemax = Books::with( 'genre' )
//            ->select('price')
            ->max('price');

        $genre = Genres::all();

        return view('Library.find', ['books'=>$books, 'minage'=>$minage, 'maxage'=>$maxage, 'pricemin'=>$pricemin, 'pricemax'=>$pricemax ]);
    }

    /**
     * Show the form find Books
     * .
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function findBooks(Request $request)
    {

        if(!$request->autors_name){

            //Валидация входных данных
            $validator = \Validator::make($request->all(), [

                'agemin' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
                'agemax' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
                'pricemin' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
                'pricemax' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
            ]);

            //Вывод ошибки
            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
            // Выбрать числа из price и age числа
            // Выброка из БД
//            $autor = $request->autors_name;
            $agemin = $request->agemin;
            $agemax = $request->agemax;
            $pricemin = $request->pricemin;
            $pricemax = $request->pricemax;

            $books = Books::with( 'genre' )
                ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', DB::raw('COUNT(*) '))
                ->whereBetween('price', array($pricemin, $pricemax))
                ->whereBetween('YearPublication', array($agemin, $agemax))
                ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description')
                ->havingRaw('COUNT(*) > 1')
                ->paginate(8);
        }
        else{

            //Валидация входных данных
            $validator = \Validator::make($request->all(), [
                'autors_name' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
//
                'agemin' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
                'agemax' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
                'pricemin' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
                'pricemax' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
            ]);
            //Вывод ошибки
            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }

            // Выбрать числа из price и age числа
            // Выброка из БД
            $autor = $request->autors_name;
            $agemin = $request->agemin;
            $agemax = $request->agemax;
            $pricemin = $request->pricemin;
            $pricemax = $request->pricemax;

            $books = Books::with( 'genre' )
                ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description')
                ->where( 'strAutor',$autor, DB::raw('COUNT(*) '))
                ->whereBetween('price', array($pricemin, $pricemax))
                ->whereBetween('YearPublication', array($agemin, $agemax))
                ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description')
                ->havingRaw('COUNT(*) > 1')
                ->paginate(8);
        }

        $minage = Books::with( 'genre' )->min('YearPublication');
        $maxage = Books::with( 'genre' )->max('YearPublication');
        $pricemin = Books::with( 'genre')->min('price');
        $pricemax = Books::with( 'genre')->max('price');

        return view('Library.find', ['books'=>$books, 'minage'=>$minage, 'maxage'=>$maxage, 'pricemin'=>$pricemin, 'pricemax'=>$pricemax ]);

    }


    public function findBook(Request $request)
    {
        //Валидация входных данных
        $validator = \Validator::make($request->all(), [
            'autors_name' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
        ]);
        //Вывод ошибки
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        // Выброка из БД
        // Выбрать числа из price и age числа

        $nameBook = $request->autors_name;

        $book = Books::with( 'genre' )
            ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
            ->where( 'books.name', $nameBook , DB::raw('COUNT(*) as products_count'))
            ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description', 'genres.genre')
            ->join('genres', 'books.genre','=','genres.idgenre')
            ->havingRaw('COUNT(*) > 1')
            ->paginate(8);

        $minage = Books::with( 'genre' )->min('YearPublication');
        $maxage = Books::with( 'genre' )->max('YearPublication');
        $pricemin = Books::with( 'genre')->min('price');
        $pricemax = Books::with( 'genre')->max('price');

        return view('Library.findBook', ['book'=>$book, 'minage'=>$minage, 'maxage'=>$maxage, 'pricemin'=>$pricemin, 'pricemax'=>$pricemax ]);

    }

    public function send(Request $request)
    {
        //Валидация входных данных
        $validator = \Validator::make($request->all(), [
            'autor' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
            'agemin' => 'required',//Проверка принадлежности атрибута к целочисленному типу
            'agemax' => 'required',//Проверка принадлежности атрибута к целочисленному типу
            'pricemin' => 'required',//Проверка принадлежности атрибута к целочисленному типу
            'pricemax' => 'required',//Проверка принадлежности атрибута к целочисленному типу
        ]);
        //Вывод ошибки
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        // Выброка из БД
        $autor = $request->autor;
        $agemin = $request->agemin;
        $agemax = $request->agemax;
        $pricemin = $request->pricemin;
        $pricemax = $request->pricemax;

        $autorDB = Books::select('books.strAutor')
            //->where( 'strAutor', $autor, 'LIKE', '%' . $autor . '%', DB::raw('COUNT(*) as products_count'))
            ->where( 'strAutor')
            ->orWhere('strAutor', 'LIKE', "%$autor%", DB::raw('COUNT(*) '))
            ->groupBy('books.strAutor')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        // Выдача на представление
        return response()->json(['autorsAjaxText' => 'Передача Удалась',
                                'autor' => $autorDB,
                                'agemin' => $agemin,
                                'agemax' => $agemax,
                                'pricemin' => $pricemin,
                                'pricemax' => $pricemax,
        ], 200);
    }

    /**
     * Ajax method find name authors  .
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function fetch(Request $request)
    {
//        //Валидация входных данных
//        $validator = \Validator::make($request->all(), [
//            'autor' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
//        ]);
//        //Вывод ошибки
//        if ($validator->fails())
//        {
//            return response()->json(['errors'=>$validator->errors()->all()]);
//        }
//        // Выброка из БД
//        $autor = $request->autor;
//        $autorDB = Books::with( 'genre' )
//            ->select('books.strAutor')
//            ->where( 'strAutor')
//            ->orWhere('strAutor', 'LIKE', "%$autor%", DB::raw('COUNT(*) '))
//            ->groupBy('books.strAutor')
//            ->havingRaw('COUNT(*) > 1')
//            ->get();
////        var_dump($autorDB);
//        //*************************************************
//        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
//
//        foreach($autorDB as $row)
//        {
//            $output .= ' <li><a href="#">'.$row->strAutor.'</a></li>';
//        }
//        $output .= '</ul>';
//        //*************************************************
//        echo $output;
        //Валидация входных данных
        $validator = \Validator::make($request->all(), [
            'autor' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
        ]);
        //Вывод ошибки
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        // Выброка из БД
        $autor = $request->autor;
        $autorDB = Books::with( 'genre' )
            ->select('books.strAutor')
            //->where( 'strAutor', $autor, 'LIKE', '%' . $autor . '%', DB::raw('COUNT(*) as products_count'))
            ->where( 'strAutor')
            ->orWhere('strAutor', 'LIKE', "%$autor%", DB::raw('COUNT(*) '))
            ->groupBy('books.strAutor')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        //*************************************************
//        $output ='autors_name'.'='.'[';
//        foreach($autorDB as $row)
//        {
//            $output .= '"'.$row->strAutor.'"'.',';
//        }
//        $output .= '_';
//        $output .= '];';
//        //*************************************************
//        echo $output;
        $data=array();
        foreach ($autorDB as $autor) {
            $data[]=array('value'=>$autor->strAutor,'id'=>$autor->id);
        }
        if(count($data))
            return $data;
        else
            $data = ['value'=>'No Result Found','id'=>''];
        return $data;
}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * //http://liblarylaravel.site/findtest?autor=Бел
     * http://liblarylaravel.site/findAutors?autor=Льюис+Кэрролл
     */
    public function test(Request $request)
    {
        //Валидация входных данных
        $validator = \Validator::make($request->all(), [
            'autors_name' => 'required',//Проверка на наличие только букв, цифр, тире и символа подчеркивания
        ]);
        //Вывод ошибки
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        // Выброка из БД
        $autor = $request->autor;

        $books = Books::with( 'genre' )
            ->select('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description')
            ->where( 'strAutor',$autor, DB::raw('COUNT(*) '))
            ->whereBetween('price', array(50, 550))
            ->whereBetween('YearPublication', array(100, 2017))
            ->groupBy('name', 'strAutor', 'Publishing', 'YearPublication', 'price', 'imageURL', 'description')
            ->havingRaw('COUNT(*) > 1')
            ->get();
//        dd($books);
        //*************************************************
//        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
//
//        $output ='[';
//        foreach($autorDB as $row)
//        {
//            $output .= '"'.$row->strAutor.'"'.',';
//        }
//       $output .= ']';
        //*************************************************
//        echo $autorDB;
//        $data=array();
//        foreach ($autorDB as $product) {
//            $data[]=array('value'=>$product->name,'id'=>$product->id);
//        }
//        if(count($data))
//            return $data;
//        else
//            $data = ['value'=>'No Result Found','id'=>''];
//            return $data;
        return view('Library.find', ['books'=>$books]);
    }

}
