<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        $books = Book::all();
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
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

     if (Auth::user()->hasPermissionTo('add books')) { 
        

            if ($book = Book::create( $request->all() )) {

                if ($request->hasFile('cover')) {
                    
                    $file = $request->file('cover');
                    $file_name = 'book_cover_'.$book->id.'.'.$file->getClientOriginalExtension();

                    $path = $request->file('cover')->storeAs(

                        'img/books',$file_name
                    );

                    $book->cover = $file_name;
                    $book->save();

                }

                return redirect()->back();
            }

        }

        return redirect()->back()->with('error','No tiene permisos');

      } 

       
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book = Book::find($request->id);
        $categories = Category::find($request->id);
        if ($book) {
            if ($book->update($request->all())) {

                return redirect()->back()->with('success',' fue posible crear el registro ');
            }
        }
        return redirect()->back()->with('error','No fue posible crear el registro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $books)
    {
        if($books){
            if($books->delete()){

                return response()->json([
                        'message' =>'registro eliminado',
                        'code' =>'200'
                ]);
            }
        }
        return response()->json([
        'message' =>'no se puede eliminar el registro',
                        'code' =>'400'
        ]);
    }
}