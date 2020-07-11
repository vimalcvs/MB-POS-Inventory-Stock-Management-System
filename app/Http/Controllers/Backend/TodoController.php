<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_todo')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.todo.index',[
            'todos' => Todo::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(20)
        ]);
    }

    public function getPendingTodos()
    {
        $tosos = Todo::where('user_id', auth()->user()->id)->where('status', 0)->get();
        return response($tosos);
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
    public function store(TodoRequest $request)
    {
       $todo = new Todo();
       $todo->title = $request->todo['title'];
       $todo->user_id = auth()->user()->id;
       $todo->date = Carbon::now()->toDateString();
       $todo->save();

       return response($todo);
    }

    public function changeStatusToCompleted($id){
        $todo = Todo::findOrFail($id);
        $todo->status = 1;
        $todo->completed_date = Carbon::now()->toDateString();
        $todo->save();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::destroy($id);
        Toastr::success('Task successfully deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
        return redirect()->back();
    }

    public function deleteTask($id)
    {
        Todo::destroy($id);
    }
}
