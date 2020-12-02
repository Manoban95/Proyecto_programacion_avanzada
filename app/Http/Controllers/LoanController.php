<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        $books = Book::all();
        $users = User::all();
        return view('loans.index', compact('loans', 'books', 'users'));
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
        if($loan = Loan::create($request->all())) {
            if ($loan) {
                return response()->json([
                    'message' => "Loan complete.",
                    'code' => "200"
                ]);
            }
            return response()->json([
                'message' => "Could not be loant.",
                'code' => "400"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $user)
    {
        $loans = Loan::all();
        $users = User::all();
        $books = Book::all();
        if(Auth::user()->hasPermissionTo('view users')){
         return view('loans.historial',compact('user','loans','users','books'));
        }else{
            return redirect()->back()->with("error","You don't have permissions");
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $loan = Loan::find($request->id);
        if ($loan) {
            if ($loan->update($request->all())) {

                return redirect()->back()->with('success',' fue posible crear el registro ');
            }
        }
        return redirect()->back()->with('error','NO fue posible crear el registro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
