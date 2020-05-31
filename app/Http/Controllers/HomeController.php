<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('tasks')->where('id_user', '=', Auth::id())->get();
        return view('home', compact('data'));
    }

    public function store_task(Request $request){

        $id = $request->get('id', false);
        $attr['id_user']= Auth::id();
        $attr['name_task']= $request->name_task;
        $attr['desc_task']= $request->desc_task;
        try{
            if($id){
                $task = Tasks::find($id);
                $task->fill($attr);
                $task->save();
                flash("Tarefa Atualizado!")->warning();
                return redirect()->route('home');
            }
            else{
                Tasks::create($attr);
                flash("Tarefa Adicionada!")->success();
                return redirect()->route('home');
            }     
        }
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }  
    }


    public function read($id){
        $data =  DB::table('tasks')->where('id_user', '=', Auth::id())->get();
        $head = Tasks::find($id);
        if($head->id_user == Auth::id()){
            return view('home', compact('data', 'head'));
        }
        else{
            flash('Produto não encontrado')->error();
            return redirect()->route('home');
        }
        
    }


    public function delete($id){
        $head = Tasks::find($id);
        
        if($head->id_user == Auth::id()){
        $head->delete();
        flash('Tarefa Deletada!')->error();
        return redirect()->route('home');
        }
        else{
            flash('Produto não encontrado')->error();
            return redirect()->route('home');
        }
    }
}
