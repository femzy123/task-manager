<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
									<h4 class="text-primary">Task List</h4>
									<p class="text-black-50"><small>Complete these tasks before their due dates.</small></p>
                  <table class="table table-hover table-sm">
										<thead class="text-primary">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Title</th>
												<th scope="col">Due Date</th>
												<th scope="col">Status</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(task, index) in tasks" :key="task.id">
												<th scope="row">{{ index + 1 }}</th>
												<td>{{ task.title }}</td>
												<td>{{ task.dueDate }}</td>
												<td>{{ task.status }}</td>
											</tr>
										</tbody>
									</table>

                </div>
                <div class="col-md-4 mt-4">
									<div class="box">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Tasks</h5>
												<BarChart
													:chart-data="chartData"
													/>																
											</div>
										</div>
									</div>
									<div class="box">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Task Status</h5>
												<p class="card-text"><small>Todo:<span class="float-right">2</span></small></p>
												<p class="card-text"><small>Ongoing:<span class="float-right">4</span></small></p>
												<p class="card-text"><small>Review:<span class="float-right">2</span></small></p>
												<p class="card-text"><small>Done:<span class="float-right">0</span></small></p>												
											</div>
										</div>
									</div>
								</div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import BarChart from './Chart.vue'

export default {
	components: { BarChart },
	data() {
		return {
			tasks: null,
			chartData: null,
			loaded: false
		}
	},
	mounted() {
		axios.get('/api/tasks')
					.then((response)=> {
						this.tasks = response.data
						// this.chartData = response.data
						
					})
					
		this.fillData()
		this.loaded = true
	},
	methods: {
		fillData() {
			this.chartData = {
				labels: [0,1,2,3,4,5],
				datasets: [
					{
						label: 'Status',
						backgroundColor: '#6574cd',
						borderColor: 'lightblue',
						pointBAckgroundColor: 'blue',
						borderWidth: 1,
						pointBorderColor: 'blue',
						data: [0,1,2,3,4,5]
					}
				]
			}
		}
	},
}
</script>

<style scoped>
	.box {
		background: #fff;
		border-radius: 5px;
		box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		margin-bottom: 1.5rem;
	}
</style>