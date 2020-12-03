<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo('view users')){
        $users = User::all();
        return view('user.index',compact('users'));
        }else
        return redirect()->back()->with('error','NO fue posible crear el registro');
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
        if($user = User::create($request->all())){
                $user->password =  Hash::make($request['password']);
                $user->save();
                return  redirect()->back()->with('success', 'User created successfully');
            }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            if ($user->update($request->all())) {
                $user->password =  Hash::make($request['password']);
                $user->save();
                return redirect()->back()->with('success',' fue posible crear el registro ');
            }
        }
        return redirect()->back()->with('error','No fue posible crear el registro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user){
            if($user->delete()){
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
