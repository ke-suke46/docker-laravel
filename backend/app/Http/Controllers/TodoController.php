<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TodoController extends Controller
    {
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(Auth::id());
        $todos = $user->todo;
        $cond_title = $request->keyword;
       if ($cond_title != '') {
         $todos = Todo::where('title','like','%'.$cond_title.'%')->orderBy('created_at','desc')->paginate(5);
       }else {
         $todos = Todo::orderBy('created_at','desc')->paginate(5);
       }
        // dd($todos);
        // if($request != ''){
        // $todos = Todo::searchKeyword($request->keyword);
        // }
        
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->user_id = $request->user()->id;
        $todo->title = $request->input('title');
        $todo->save();
    
        return redirect('todo')->with(
            'status',
            $todo->title . 'を登録しました!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);

        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);

        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);

        $todo->title = $request->input('title');
        $todo->save();
    
        return redirect('todo')->with(
            'status',
            $todo->title . 'を更新しました!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
    
        return redirect('todo')->with(
            'status',
            $todo->title . 'を削除しました!'
        );
    }
    
}
