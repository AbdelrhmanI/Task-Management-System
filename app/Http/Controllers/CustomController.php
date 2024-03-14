<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Session;

class CustomController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function registration(){
        return view('auth.registration');
    }

    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $res = $user->save();
        if($res){
            return back()->with('success','You have Registered successfuly');
        }else{
            return back()->with('fail','Something wrong happend');
        }
    }

    public function loginUser(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            if ($request->password === $user->password) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password does not match.');
            }
        } else {
            return back()->with('fail', 'This email is not registered.');
        }
    }

    public function dashboard()
    {
        $user = User::find(Session::get('loginId')); // Retrieve the logged-in user

        if ($user) {
            $tasks = Task::where('UserID', $user->id)->get();
            return view('dashboard', ['data' => $user, 'tasks' => $tasks]);
        } else {
            return redirect()->route('login')->with('fail', 'User not found.');
        }
    }

    public function logout() {
            
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }

    public function create(Request $request){
        $users = User::all(); 
        return view('tasks.create', compact('users'));
    }

    public function createTask(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user' => 'required|exists:users,id' // Ensure the selected user exists
        ]);
    
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->UserID = $request->user; // Assign the task to the selected user
        $res = $task->save();
    
        if($res){
            return back()->with('success','Task created successfully');
        } else {
            return back()->with('fail','Something went wrong');
        }
    }

    public function editTask(Task $task){
        $users = User::all();
        return view('tasks.edit', ['task' => $task, 'users' => $users]);
    }

    public function updateTask(Request $request, Task $task){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user' => 'required|exists:users,id' // Ensure the selected user exists
        ]);
    
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->UserID = $request->user; // Assign the task to the selected user
        $res = $task->save();
    
        if($res){
            return back()->with('success','Task updated successfully');
        } else {
            return back()->with('fail','Something went wrong');
        }
    }

    public function deleteTask(Task $task){
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully');
    }
    

}
