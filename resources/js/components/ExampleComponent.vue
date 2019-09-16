<template>
  <div>
    <div class="container mb-4">
      <div class="row">
        <div class="col-12">
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addTask">Add Task</button>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
          <div class="col-md-3">
            <div class="font-weight-bold mb-3">Todo</div>
              <div class="p-3 todoBox overflow-auto">
                <div class="card mb-3" v-for="task in tasks" :key="task.id">
                  <div class="card-header"><span class="font-weight-bold">{{ task.title }}</span><small class="float-right"><strong>Due:</strong> {{ task.dueDate}}</small></div>

                  <div class="card-body">
                      <p class="card-text">{{ task.description }}</p>
                      <div><span class="text-primary"><i class="fa fa-eye" style="font-size:24px"></i></span>
                      <span class="float-right" @click="deleteTask(task.id)"><i class="fa fa-trash" style="font-size:24px;color:red"></i></span></div>
                  </div>
              </div>
              </div>
          </div>

          <div class="col-md-3">
            <div class="font-weight-bold mb-3">Ongoing</div>
              <div class="p-3 todoBox overflow-auto">
                <div class="card mb-3" v-for="task in tasks" :key="task.id">
                  <div class="card-header"><span class="font-weight-bold">{{ task.title }}</span><small class="float-right"><strong>Due:</strong> {{ task.dueDate}}</small></div>

                  <div class="card-body">
                      <p class="card-text">{{ task.description }}</p>
                      <div><span class="text-primary"><i class="fa fa-eye" style="font-size:24px"></i></span>
                      <span class="float-right" @click="deleteTask(task.id)"><i class="fa fa-trash" style="font-size:24px;color:red"></i></span></div>
                  </div>
              </div>
              </div>
          </div>

          <div class="col-md-3">
            <div class="font-weight-bold mb-3">Review</div>
              <div class="p-3 todoBox overflow-auto">
                <div class="card mb-3" v-for="task in tasks" :key="task.id">
                  <div class="card-header"><span class="font-weight-bold">{{ task.title }}</span><small class="float-right"><strong>Due:</strong> {{ task.dueDate}}</small></div>

                  <div class="card-body">
                      <p class="card-text">{{ task.description }}</p>
                      <div><span class="text-primary"><i class="fa fa-eye" style="font-size:24px"></i></span>
                      <span class="float-right" @click="deleteTask(task.id)"><i class="fa fa-trash" style="font-size:24px;color:red"></i></span></div>
                  </div>
              </div>
              </div>
          </div>

          <div class="col-md-3">
            <div class="font-weight-bold mb-3">Done</div>
              <div class="p-3 todoBox overflow-auto">
                <div class="card mb-3" v-for="task in tasks" :key="task.id">
                  <div class="card-header"><span class="font-weight-bold">{{ task.title }}</span><small class="float-right"><strong>Due:</strong> {{ task.dueDate}}</small></div>

                  <div class="card-body">
                      <p class="card-text">{{ task.description }}</p>
                      <div><span class="text-primary"><i class="fa fa-eye" style="font-size:24px"></i></span>
                      <span class="float-right" @click="deleteTask(task.id)"><i class="fa fa-trash" style="font-size:24px;color:red"></i></span></div>
                  </div>
              </div>
              </div>
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

    export default {
        data() {
            return {
              user: [],
              tasks: [],
              title: '',
              description: '',
              dueDate: ''
            }
        },
        mounted() {
            axios.get('/api/tasks')
            .then((response)=> {
                console.log(response.data)
                this.tasks = response.data
            })

            axios.get('/api/user')
            .then((response)=> {
                console.log(response.data)
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
              console.log("Everything works")
            })

          },
          deleteTask(id) {
          axios.delete('/api/tasks/'+ id)
          .then((response)=>{
            console.log("deleted")
          })
          window.location.reload()
        
        },
      }
        
    }
</script>

<style scoped>
.todoBox {
  background: #fff;
  border: 0.5px solid whitesmoke;
  border-radius: 5px;
  box-shadow: 0px -1px 0px 2px whitesmoke;
  height: 70vh;
}
</style>