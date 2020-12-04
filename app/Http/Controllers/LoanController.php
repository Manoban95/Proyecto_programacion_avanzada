<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    /*public function all(Request $request)
    {
        $loans = Loan::all();
        return response(json_encode($loans),200)->header('Content-type','text/plain');
    }*/

    public function all()
    {
            
           $dashboardUser = User::select (DB::raw("COUNT(*) as count"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('count');

            $dashboardMonthUser = User::select (DB::raw("Month(created_at) as month"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');

            $datasUser = array(0,0,0,0,0,0,0,0,0,0,0,0);

            $dashboardLoan = Loan::select (DB::raw("COUNT(*) as count"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('count');

            $dashboardMonthLoan = Loan::select (DB::raw("Month(created_at) as month"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');

            $datasLoan = array(0,0,0,0,0,0,0,0,0,0,0,0);

                  foreach ($dashboardMonthUser as $dashboard => $month) {
                $datasUser[$month] = $dashboardUser[$dashboard];
            }

            foreach ($dashboardMonthLoan as $dashboard => $month) {
                $datasLoan[$month] = $dashboardLoan[$dashboard];
            }

            $loans = Loan::all();
            $data= response($loans,200)->header('Content-type','text/plain');
            
            return view('dashboard', compact('datasLoan','data')) ;

   
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
                    'message' => "Prestamo realizado",
                    'code' => "200"
                ]);
            }
            return response()->json([
                'message' => "No se ha podido realizar el préstamo",
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
            return redirect()->back()->with("error","No tienes permiso");
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
                return response()->json([
                        'message' =>'registro eliminado',
                        'code' =>'200'
                ]);
                return redirect()->back()->with('success',' fue posible crear el registro ');
            }else{
                return response()->json([
                'message' =>'no se puede eliminar el registro',
                                'code' =>'400'
                ]);
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
