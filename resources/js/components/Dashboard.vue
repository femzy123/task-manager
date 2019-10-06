<template>
    <div>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="box p-1">
							<div class="card bg-primary text-white">
								<div class="card-body">
									<h5 class="card-title">Task</h5>
									<p class="card-text">Todo:<span class="float-right">{{ todo - 1 }}</span></p>												
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box p-1">
							<div class="card bg-secondary text-white">
								<div class="card-body">
									<h5 class="card-title">Task</h5>
									<p class="card-text">Ongoing:<span class="float-right">{{ ongoing - 1 }}</span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box p-1">
							<div class="card bg-dark text-white">
								<div class="card-body">
									<h5 class="card-title">Task</h5>
									<p class="card-text">Todo<span class="float-right">{{ review - 1 }}</span></p>											
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box p-1">
							<div class="card bg-danger text-white">
								<div class="card-body">
									<h5 class="card-title">Task</h5>
									<p class="card-text">Done:<span class="float-right">{{ done - 1 }}</span></p>												
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
					<div class="row">
							<div class="col-md-8">
								<div class="box p-5">
									<div class="row">
										<div class="col-6">
											<h4 class="text-primary">Task List</h4>
											<p class="text-black-50"><small>Complete these tasks before their due dates.</small></p>
										</div>
										<div class="col-6 text-right"><a href="/tasks"><i class="fa fa-plus-circle text-primary" style="font-size: 36px"></i></a></div>
									</div>
									
									<table class="table table-hover table-sm">
										<thead class="text-primary">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Title</th>
												<th scope="col">Due Date</th>
												<th scope="col">Status</th>
											</tr>
										</thead>
										<tbody class="text-primary">
											<tr v-for="(task, index) in tasks" :key="task.id">
												<th scope="row">{{ index + 1 }}</th>
												<td class="text-capitalize">{{ task.title }}</td>
												<td>{{ task.dueDate }}</td>
												<td class="text-capitalize" :class="statusColor">{{ task.status }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-4">
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
											<h5 class="card-title">Tasks</h5>																
												<canvas ref="chart" id="myChart" width="400" height="400"></canvas>
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
import Chart from 'chart.js'

export default {
	components: { BarChart },
	data() {
		return {
			tasks: "",
			chartData: "",
			loaded: false,
			todo: 1,
			ongoing: 1,
			review: 1,
			done: 1,
			statusColor: "text-warning"
		}
	},
	mounted() {
		axios.get('/api/tasks')
					.then((response)=> {
						this.tasks = response.data
					
					for(var i = 0; i < this.tasks.length; i++){
						if(this.tasks[i].status === 'done'){
							this.done++
						} else if (this.tasks[i].status === 'ongoing'){
							this.ongoing++
						} else if (this.tasks[i].status === 'review'){
							this.review++
						} else {
							this.todo++
						}
					}

						this.pieChart()
						this.fillData()
				})
		
		this.loaded = true
	},
	methods: {
		fillData() {
			this.chartData = {
				labels: ['Todo', 'Ongoing', 'Review', 'Done'],
				datasets: [
					{
						label: 'Task Stats',
						backgroundColor: [
										'#F44000',
										'#36A2EB',
										'#FF9F40',
										'#89cd5a'
									],
						borderColor: 'lightblue',
						pointBackgroundColor: 'blue',
						borderWidth: 1,
						pointBorderColor: 'blue',
						data: [this.todo, this.ongoing, this.review, this.done]
					}
				]
			}
		},
		pieChart() {
			// const ctx = document.getElementById('myChart');
			const ctx = this.$refs.chart
			const myChart = new Chart(ctx, {
					type: 'doughnut',
					data: {
							labels: ['Todo', 'Ongoing', 'Review', 'Done'],
							datasets: [{
									label: 'Task Stats',
									data: [this.todo, this.ongoing, this.review, this.done],
									backgroundColor: [
											'#F44000',
											'#36A2EB',
											'#FF9F40',
											'#89cd5a'
									]
							}]
					},
					// options: {
					// 		scales: {
					// 				yAxes: [{
					// 						ticks: {
					// 								beginAtZero: true
					// 						}
					// 				}]
					// 		}
					// }
			});
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