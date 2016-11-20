<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Carbon\Carbon;
class TaskController extends Controller
{
    protected $statusMigrateRules = [
        'pending' => 'complete',
        'complete' => 'archived'
    ];
    public function index ()
    {
        return Task::where('users_id',auth()->user()->id)->get();
    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);
        $data =$request->all();
        $data['users_id'] = auth()->user()->id;
        Task::create($data);
        return ['status'=>1];
    }
    public function update(Request $request,$id)
    {
        $task = Task::findOrFail($id);
        $data =$request->all();
        $data['updated_at'] = Carbon::now();
        $task->fill($data)->update();
        return ['status'=>1];
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return ['status'=>1];
    }
    public function updateAll($status){
        $data = [
            'status' => $this->statusMigrateRules[$status],
            'updated_at' => Carbon::now()
        ];
        Task::where('status',$status)
        ->update($data);
        return ['status'=>1];
    }
    public function destroyAll($status){
        Task::where('status',$status)->delete();
        return ['status'=>1];
    }
}
