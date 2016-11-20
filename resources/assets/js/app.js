require('./bootstrap');

Vue.component('task', require('./components/task.vue'));

const app = new Vue({
    el: '#app',
    created: function(){
        this.fetchAllTask();
        this.$on('taskEditEmiter', taskId =>{
            this.taskEdit(taskId);
        });
        this.$on('taskCompleteEmiter', taskId =>{
            this.taskComplete(taskId);
        });
        this.$on('taskPendingEmiter', taskId =>{
            this.taskPending(taskId);
        });
        this.$on('taskArchivedEmiter', taskId =>{
            //console.log('i m parent');
            this.taskArchived(taskId);
        });
        this.$on('taskDeleteEmiter', taskId =>{
            this.taskDelete(taskId);
        });
    },
    data: {
        pendingAndCompleteTasksView: true,
        addTaskView: false,
        editTaskView: false,
        archivedTasksView: false,
        tasks: [],
        newTask: {
            title: '',
            description: '',
            due_date: ''
        },
        currentTaskId: '',
    },
    methods: {
        toggleShowTasks: function(type=null){
            if(type=="addTask"){
                this.addTaskView = true;
                this.pendingAndCompleteTasksView=false;
                this.archivedTasksView=false;
            }
            else if(type==="archived")
            {
                this.addTaskView = false;
                this.pendingAndCompleteTasksView=false;
                this.archivedTasksView=true;
            }
            else{
                this.addTaskView = false;
                this.pendingAndCompleteTasksView=true;
                this.archivedTasksView=false;
            }
        },
        fetchAllTask: function() {
            this.$http.get('/api/task').then((response) => {
                this.tasks = response.body;
            }, (response) => {
                toastr.error(response.statusText);
                //console.log(response.body);
            });
        },
        pendingTasks: function(){
            return this.tasks.filter(function(task){
                return task.status=="pending";
            });
        },
        completeTasks: function(){
            return this.tasks.filter(function(task){
                return task.status=="complete";
            });
        },
        archivedTasks: function(){
            return this.tasks.filter(function(task){
                return task.status=="archived";
            });
        },
        addNewTask: function(){
            if(this.newTask.title){
                this.$http.post('/api/task/',this.newTask).then((response) => {
                    if(response.body.status){
                        toastr.success('Task added!');
                        this.newTask = {title:'',description:'',due_date:''};
                        this.fetchAllTask();
                    }
                    else {
                        toastr.warning('Something went wrong!');
                    }
                }, (response) => {
                    toastr.error(response.statusText);
                    //console.log(response.body);
                });
            }
        },
        taskEdit: function(taskId){
            //change view
            this.toggleShowTasks("addTask");
            this.editTaskView = true;
            var task = this.tasks.filter(function(task){
                return task.id==taskId;
            });
            this.newTask.title = task[0].title;
            this.newTask.description = task[0].description;
            var dd = new Date(task[0].due_date);
            this.newTask.due_date = dd.getFullYear()+'-'+(dd.getMonth()+1)+'-'+dd.getDate();
            this.currentTaskId = task[0].id;
        },
        taskUpdate: function(){
            this.$http.patch('/api/task/'+this.currentTaskId,this.newTask).then((response) => {
                if(response.body.status){
                    toastr.success('Task Updated!');
                    this.toggleShowTasks();
                    this.editTaskView = false;
                    this.currentTaskId = '';
                    this.newTask = {title:'',description:'',due_date:''};
                    this.fetchAllTask();
                }
                else {
                    toastr.warning('Something went wrong!');
                }
            }, (response) => {
                toastr.error(response.statusText);
                //console.log(response.body);
            });
        },
        taskComplete: function(taskId) {
            this.$http.patch('/api/task/'+taskId,{status:'complete'}).then((response) => {
                if(response.body.status){
                    toastr.success('Task completed!');
                    this.fetchAllTask();
                }
                else {
                    toastr.warning('Something went wrong!');
                }
            }, (response) => {
                toastr.error(response.statusText);
                //console.log(response.body);
            });
        },
        taskPending: function(taskId) {
            this.$http.patch('/api/task/'+taskId,{status:'pending'}).then((response) => {
                if(response.body.status){
                    toastr.success('Task move to pending!');
                    this.fetchAllTask();
                }
                else {
                    toastr.warning('Something went wrong!');
                }
            }, (response) => {
                toastr.error(response.statusText);
                //console.log(response.body);
            });
        },
        taskArchived: function(taskId) {
            this.$http.patch('/api/task/'+taskId,{status:'archived'}).then((response) => {
                if(response.body.status){
                    toastr.success('Task archived!');
                    this.fetchAllTask();
                }
                else {
                    toastr.warning('Something went wrong!');
                }
            }, (response) => {
                toastr.error(response.statusText);
                //console.log(response.body);
            });
        },
        taskDelete: function(taskId) {
            this.$http.delete('/api/task/'+taskId).then((response) => {
                if(response.body.status){
                    this.tasks= this.tasks.filter(function(task){
                        return task.id!=taskId;
                    });
                    toastr.success('Task deleted!');
                }
                else {
                    toastr.warning('Something went wrong!');
                }
            }, (response) => {
                toastr.error(response.statusText);
                //console.log(response.body);
            });
        },
        taskCompleteAll: function(){
            var vm = this;
            swal({
                title: 'Are you sure?',
                text: "You completed all tasks!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
            }).then(function () {
                vm.$http.patch('/api/task-all/pending').then((response) => {
                    if(response.body.status){
                        toastr.success('All task completed!');
                        vm.fetchAllTask();
                    }
                    else {
                        toastr.warning('Something went wrong!');
                    }
                }, (response) => {
                    toastr.error(response.statusText);
                    //console.log(response.body);
                });
            });

        },
        taskArchiveAll: function(){
            var vm = this;
            swal({
                title: 'Are you sure?',
                text: "You want to archived all tasks!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, archived it!'
            }).then(function () {
                vm.$http.patch('/api/task-all/complete').then((response) => {
                    if(response.body.status){
                        toastr.success('All task archived!');
                        vm.fetchAllTask();
                    }
                    else {
                        toastr.warning('Something went wrong!');
                    }
                }, (response) => {
                    toastr.error(response.statusText);
                    //console.log(response.body);
                });
            });

        },
        taskDeleteAll: function(type){
            var vm = this;
            swal({
                title: 'Are you sure?',
                text: "You want to delete all tasks!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                vm.$http.delete('/api/task-all/'+type).then((response) => {
                    if(response.body.status){
                        toastr.success('All task deleted!');
                        vm.fetchAllTask();
                    }
                    else {
                        toastr.warning('Something went wrong!');
                    }
                }, (response) => {
                    toastr.error(response.statusText);
                    //console.log(response.body);
                });
            });

        }
    },
    computed: {
        pending: function(){
            return this.pendingTasks().length;
        },
        complete: function(){
            return this.completeTasks().length;
        },
        pendingAndComplete: function(){
            return this.pendingTasks().length+this.completeTasks().length;
        },
        archived: function(){
            return this.archivedTasks().length;
        }
    }
});
