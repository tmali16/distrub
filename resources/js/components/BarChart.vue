<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h3>Выявленные нарушения</h3>
                <p>по учреждениям</p>

            </div>
            <div class="col-md-12">
                <b-row>
                    <input type="date" v-model="start" class="form-control col-md-2 form-control-sm mr-3" name="" id=""> -
                    <input type="date" v-model="end" class="form-control col-md-2 form-control-sm ml-3 mr-3" name="" id="">
                    <button @click="update" class="btn btn-sm text-white mr-3" style="background-color:#269dff;"><i class="fa fa-redo"></i></button>
                </b-row>
            </div>
            <div class="col-md-12">
                <bar-chart :chart-data="data" :width="800" :options="options"></bar-chart>
            </div>
        </div>
    </div>
</template>

<script>
import BarChart from "./BarChart.js";
    export default {
        components:{
            BarChart
        },
        props:[],
        data(){
            return{
                data: [],
                start: '01.01.2021',
                end: '30.01.2021',
                options:{
                    type: 'horizontalBar',
                    responsive: true,
                    maintainAspectRatio: true,
                    animation: {
                        duration: 15 // general animation time
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,                                
                                stepSize: 1
                            }
                    }]
                    }
                }
            }
        },
        computed:{

        },
        mounted() {
            this.update()
        },
        methods: {
            update: function() {
                if(this.start != null && this.end != null && this.start < this.end){
                    let g = {
                        start:this.start,
                        end: this.end
                    }
                    axios.post("/api/distrub/chart/prison",g).then(d=>{
                        this.data = d.data
                        console.log(this.data)
                    })
                }
            },
        },
    }
</script>
