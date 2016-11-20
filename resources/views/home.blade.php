@extends('layouts.app')
@section('style')
<style media="screen">
[v-cloak]{
    display: none;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div v-if="addTaskView" >
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h2 class="text-default"><i class="glyphicon glyphicon-pencil"></i> @{{ editTaskView ? 'Update' : 'New'}} Task</h2>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" v-model="newTask.title" value="" placeholder="Task title">
                                <span v-show="newTask.title==''" class="text-danger">* Task title required!</span>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" v-model="newTask.description" value="" placeholder="Task description"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="date" v-model="newTask.due_date" value="" placeholder="Task dead line">
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <button v-show="newTask.title!='' && !editTaskView" @click="addNewTask" type="button" class="btn btn-primary"> <i class="glyphicon glyphicon-plus"></i> Add</button>
                        <button v-show="newTask.title!='' && editTaskView" @click="taskUpdate" type="button" class="btn btn-primary"> <i class="glyphicon glyphicon-edit"></i> Update</button>
                    </div>
                </div>
            </div>
            <div v-else>
                <div v-if="pendingAndCompleteTasksView">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h2 class="text-info" ><i class="glyphicon glyphicon-list-alt"></i> Tasks(@{{pendingAndComplete}})</h2>
                        </div>
                        <div class="panel-body">
                            <div  :class="complete ? 'col-lg-6':'col-lg-12'" v-if="pending">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <h4 class="text-info"><i class="glyphicon glyphicon-list"></i> Pending(@{{pending}})</h4>
                                        <div v-for="task in pendingTasks()">
                                            <task :pending="true" :class="'panel-info'" :task="task"></task>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span @click="taskCompleteAll()" title="All Complete?" class="text-success"> <i class="glyphicon glyphicon-check"></i></span>
                                        <span @click="taskDeleteAll('pending')" title="All Delete?" class="pull-right text-danger"> <i class="glyphicon glyphicon-trash"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div :class="pending ? 'col-lg-6':'col-lg-12'" v-if="complete">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <h4 class="text-success"><i class="glyphicon glyphicon-check"></i> Completed(@{{complete}})</h4>
                                        <div   v-for="task in completeTasks()">
                                            <task :complete="true" :class="'panel-success'" :task="task" ></task>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span @click="taskArchiveAll()" title="All Archived?" class="text-primary"> <i class="glyphicon glyphicon-inbox"></i></span>
                                        <span @click="taskDeleteAll('complete')" title="All Delete?" class="pull-right text-danger"> <i class="glyphicon glyphicon-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">

                            <h2 class="text-default"><i class="glyphicon glyphicon-inbox"></i> Archived Tasks(@{{archived}})</h2>
                        </div>

                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div v-for="task in archivedTasks()">
                                    <task :class="'panel-primary'" :task="task"></task>
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <span v-show="archived" @click="taskDeleteAll('archived')" title="All Delete?" class="pull-right text-danger"> <i class="glyphicon glyphicon-trash"></i></span>
                            <br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="/js/app.js"></script>
@if (session('message'))
<script>
toastr.success('{{session('message')}}');
</script>
@endif
@endsection
