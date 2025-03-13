<?php

namespace App\Http\Controllers;

use App\Models\Book;

use App\Models\Dojo;
use App\Models\Ninja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//给用户做认证
    }

    //秘籍名称查询

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Book::query();
        $search = $request->input('keyword');
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $perPage = 3;
        $query->where('status', 1);
        $query->orderBy('created_at', 'desc');
        $books = $query->paginate($perPage);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dojos = Dojo::all();
        $ninjas = Ninja::all();
        return view('books.create', compact('dojos', 'ninjas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'ninja_id' => 'required|numeric',
            'dojo_id' => 'required|numeric',
            'status' => 'required|numeric',
            'description' => 'required|string|max:255'
        ]);

        if (Book::create($validatedData)) {
            return redirect()->route('books.index');
        }
        return response()->json(['error' => 'Book data create failed', 400]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //1.原生SQL
//        $book=DB::select(
//            'Select books.id,books.name,
//       books.dojo_id,books.ninja_id,books.description
//        from books
//            inner join dojos on books.dojo_id=dojos.id
//            inner join ninjas on books.ninja_id=ninjas.id
//            where books.id='.$id)[0];

        //2.查询构造器
//        $book = DB::table('books')
//            ->join('dojos', 'dojo_id', '=', 'dojos.id')
//            ->join('ninjas', 'ninja_id', '=', 'ninjas.id')
//            ->select(
//                'books.id', 'books.name', 'books.dojo_id', 'books.ninja_id',
//                'books.description')
////            ->where('books.id', $id)
//            ->first($id);
//dd($book);
        //3.模型 Eloquent模块,是一个对象关系映射 (ORM)
        $book = Book::with('dojo')->with('ninja')->findOrFail($id);
        $dojos = Dojo::all();
        $ninjas = Ninja::all();

        return view('books.edit', compact(['book', 'dojos', 'ninjas']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $book = Book::findOrFail($id);
        if ($book) {
            $request->validate([
                'name' => 'required|string|min:2',
                'ninja_id' => 'required|numeric',
                'dojo_id' => 'required|numeric',
                'description' => 'required|string|min:2'
            ]);
            $book->name = $request->name;
            $book->ninja_id = $request->ninja_id;
            $book->dojo_id = $request->dojo_id;
            $book->description = $request->description;
            $book->status = 1;
            if ($book->save()) {
                return redirect()->route('books.index');
            }
            return response()->json(['error' => 'Book data update failed', 400]);
        } else {
            return response()->json(['error' => 'Book not found', 404]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::findOrFail($id);
        if ($book) {
            $book->status = 0;
            $book->save();
            return redirect()->route('books.index');
        } elseif (is_null($book)) {
            return response()->json(['error' => 'Book not found', 404]);
        }
    }
}
