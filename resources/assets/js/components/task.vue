<template>
<div class="panel task-panel childClass">
    <div class="panel-heading">
    <h4 class="panel-title">
   <a class="task" data-toggle="collapse" data-parent="#accordion" :href="'#'+task.id">
   {{task.title}}
   <span v-if="pending" class="pull-right"><i class="glyphicon glyphicon-calendar"></i> {{task.due_date}}</span>
   <span v-else class="pull-right"><i class="glyphicon glyphicon-time"></i> {{task.updated_at}}</span>
   </a>
   </h4>
    </div>
    <div :id="task.id" class="panel-collapse collapse">
    <div class="panel-body">
        <p>{{task.description}}</p>
    </div>
    <div class="panel-footer">
    <span v-if="pending" @click="taskComplete(task.id)" title="Complete?" class="text-success"> <i class="glyphicon glyphicon-ok"></i></span>
    <span v-if="pending" @click="taskEdit(task.id)" title="Edit?" class="pull-left text-info" style="width:50%;"> <i class="glyphicon glyphicon-edit"></i></span>
    <span v-if="complete" @click="taskPending(task.id)" title="Pending?" class="pull-left text-primary" style="width:50%;"> <i class="glyphicon glyphicon-arrow-left"></i></span>
    <span v-if="complete" @click="taskArchived(task.id)" title="Archive?" class="text-primary"> <i class="glyphicon glyphicon-inbox"></i></span>
    <span @click="taskDelete(task.id)" title="Delete?" class="text-danger pull-right"> <i class="glyphicon glyphicon-trash"></i></span>
    <br>
    </div>
    </div>
</div>

</template>

<script>

    export default {
        mounted() {
            //console.log('Component ready.')
        },
        props: ['task','pending','complete'],
        methods: {
         taskEdit: function(taskId){
            this.$parent.$emit('taskEditEmiter', taskId);
         },
         taskComplete: function(taskId){
            this.$parent.$emit('taskCompleteEmiter', taskId);
         },
         taskPending: function(taskId){
            this.$parent.$emit('taskPendingEmiter', taskId);
         },
         taskArchived: function(taskId){
            this.$parent.$emit('taskArchivedEmiter', taskId);
         },
         taskDelete: function(taskId){
            var vm = this;
            swal({
              title: 'Are you sure?',
              text: "You want to delete this task!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then(function () {
               vm.$parent.$emit('taskDeleteEmiter', taskId);
            });
        }
      }
    }
</script>
