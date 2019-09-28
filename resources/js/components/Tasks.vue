<template>
  <div>
    <div class="container mb-4">
      <div class="row">
        <div class="col-12">
          <div class="alert alert-primary" role="alert" v-if="noTask">
            You have no tasks. Create a task by clicking the "Add Task" button below.
          </div>
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addTask">Add Task</button>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
          <div class="col-md-3 mb-4">
            <div class="font-weight-bold mb-3">Todo</div>

              <draggable :lists="tasks" :options="{animation:200, group:'status'}" :elements="'ul'" class="list-group p-3 todoBox overflow-auto" @add="onAdd($event, 'todo')">
                <li class="list-group-item mb-2" v-for="(task, index) in todoTasks" :key="task.id" :data-id="task.id">
                  <h6 class="font-weight-bold">{{ task.title }}</h6>
                  <hr>
                  <div>
                    <span class="text-secondary"><small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ task.dueDate}}</small></span>
                    <span class="float-right text-secondary">
                      <i class="fa fa-eye mr-2" style="font-size:14px"  data-toggle="tooltip" data-placement="bottom" title="View Task"></i>
                      <i class="fa fa-trash" style="font-size:14px" @click="deleteTask(task.id)"></i>
                    </span>
                  </div>
                </li>
              </draggable>

          </div>

          <div class="col-md-3 mb-4">
            <div class="font-weight-bold mb-3">Ongoing</div>

              <draggable :lists="tasks" :options="{animation:200, group:'status'}" :elements="'ul'" class="list-group p-3 todoBox overflow-auto" @add="onAdd($event, 'ongoing')">
                <li class="list-group-item mb-2" v-for="(task, index) in ongoingTasks" :key="task.id" :data-id="task.id">
                  <h6 class="font-weight-bold">{{ task.title }}</h6>
                  <hr>
                  <div>
                    <span class="text-secondary"><small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ task.dueDate}}</small></span>
                    <span class="float-right text-secondary">
                      <i class="fa fa-eye mr-2" style="font-size:14px"  data-toggle="tooltip" data-placement="bottom" title="View Task"></i>
                      <i class="fa fa-trash" style="font-size:14px" @click="deleteTask(task.id)"></i>
                    </span>
                  </div>
                </li>
              </draggable>

          </div>

          <div class="col-md-3 mb-4">
            <div class="font-weight-bold mb-3">Review</div>

              <draggable :lists="tasks" :options="{animation:200, group:'status'}" :elements="'ul'" class="list-group p-3 todoBox overflow-auto" @add="onAdd($event, 'review')">
                <li class="list-group-item mb-2" v-for="(task, index) in reviewTasks" :key="task.id" :data-id="task.id">
                  <h6 class="font-weight-bold">{{ task.title }}</h6>
                  <hr>
                  <div>
                    <span class="text-secondary"><small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ task.dueDate}}</small></span>
                    <span class="float-right text-secondary">
                      <i class="fa fa-eye mr-2" style="font-size:14px"  data-toggle="tooltip" data-placement="bottom" title="View Task"></i>
                      <i class="fa fa-trash" style="font-size:14px" @click="deleteTask(task.id)"></i>
                    </span>
                  </div>
                </li>
              </draggable>

          </div>

          <div class="col-md-3 mb-4">
            <div class="font-weight-bold mb-3">Done</div>

              <draggable :lists="tasks" :options="{animation:200, group:'status'}" :elements="'ul'" class="list-group p-3 todoBox overflow-auto" @add="onAdd($event, 'done')">
                <li class="list-group-item mb-2" v-for="(task, index) in doneTasks" :key="task.id" :data-id="task.id">
                  <h6 class="font-weight-bold">{{ task.title }}</h6>
                  <hr>
                  <div>
                    <span class="text-secondary"><small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ task.dueDate}}</small></span>
                    <span class="float-right text-secondary">
                      <i class="fa fa-eye mr-2" style="font-size:14px"  data-toggle="tooltip" data-placement="bottom" title="View Task"></i>
                      <i class="fa fa-trash" style="font-size:14px" @click="deleteTask(task.id)"></i>
                    </span>
                  </div>
                </li>
              </draggable>

          </div>
      </div>
    </div>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask">
      Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTaskTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTaskTitle">Add New Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Title" v-model="title">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" placeholder="Description" v-model="description"></textarea>
              </div>
              <div class="form-group">
                <label for="dueDate">Due Date</label>
                <input type="date" class="form-control" id="dueDate" v-model="dueDate">
              </div>
              <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="addTask">Add</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    
</template>

<script>
import axios from 'axios'
import draggable from 'vuedraggable'

    export default {
      components: {
            draggable,
        },
        data() {
            return {
              user: [],
              tasks: [],
              todoTasks:[],
              ongoingTasks:[],
              reviewTasks:[],
              doneTasks:[],
              title: '',
              description: '',
              dueDate: '',
              status: '',
              noTask: false
            }
        },
        mounted() {
            axios.get('/api/tasks')
            .then((response)=> {
                console.log(response.data)
                this.tasks = response.data

                if( this.tasks.length === 0) {
                  this.alert = true
                }

                for(var i=0; i < this.tasks.length; i++){
                  if(this.tasks[i].status == "todo"){
                    this.todoTasks.push(this.tasks[i])
                  }
                }

                for(var i=0; i < this.tasks.length; i++){
                  if(this.tasks[i].status == "ongoing"){
                    this.ongoingTasks.push(this.tasks[i])
                  }
                }

                for(var i=0; i < this.tasks.length; i++){
                  if(this.tasks[i].status == "review"){
                    this.reviewTasks.push(this.tasks[i])
                  }
                }

                for(var i=0; i < this.tasks.length; i++){
                  if(this.tasks[i].status == "done"){
                    this.doneTasks.push(this.tasks[i])
                  }
                }
            })

            axios.get('/api/user')
            .then((response)=> {
                // console.log(response.data)
                this.user = response.data
            })
        },
        methods: {
          addTask() {
            
            var data = {
              "user_id": this.user.id,
              "title": this.title,
              "description": this.description,
              "dueDate": this.dueDate
            }
            var url ='/api/tasks'

            axios.post( url, data, { headers: {'Content-Type': 'application/json'}})
            .then((response)=>{
              // console.log("Everything works")
              window.location.reload()
            })

          },
          deleteTask(id) {
            axios.delete('/api/tasks/'+ id)
            .then((response)=>{
              console.log("deleted")
            })
            window.location.reload()
          
          },
          onAdd(event, status) {
            // console.log(event.item)
            let id = event.item.getAttribute('data-id')
            axios.put('/api/tasks/'+ id, {
              user_id: this.user.id,
              status: status
            }, { headers: {'Content-Type': 'application/json'}})
            .then((response)=> {
              // console.log("Job well done")
            })
          }
      }
        
    }
</script>

<style scoped>
.todoBox {
  background: #fff;
  border: 0.5px solid whitesmoke;
  border-radius: 5px;
  /* box-shadow: 0px -1px 0px 2px whitesmoke; */
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  height: 70vh;
}

.my-handle {
  cursor:move;
}
</style>