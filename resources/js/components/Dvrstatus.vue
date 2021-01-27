<template>
    <div class="bg-white px-4 py-2 ">
        <div class="grid grid-cols-5 gap-4">
            <div
                class="relative bg-gray-200 p-2 col-span-1 px-4 py-4"
                v-for="(item, i) in prisions"
                :key="i"                
            >
                <h4 class="py-2 mb-5">{{ item.name }}</h4>
                <div class="grid grid-cols-4 gap-3 ">
                    <div v-for="(dvr, ind) in item.dvr" :key="ind" class="px-2 relative py-2 col-span-1 bg-white ">
                        {{dvr.name}}
                        <div class="absolute z-2 top-0 right-0 ring-4 ring-gray-200 h-3 w-3 animate__animated animate__fast rounded-full" :class="dvr.status.statusid == 5 ? 'bg-red-500 animate__fadeIn animate__infinite animate__fadeOut' : ' bg-green-500'"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',    
    key: process.env.MIX_PUSHER_APP_KEY,
    // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    disableStats: true,
});
export default {
    props: [],
    data() {
        return {
            prisions: [],
            sensorData: []
        };
    },
    computed: {
        
    },
    mounted() {
        setInterval(() => {
            this.getDvr()
        }, 300000);
        this.getDvr();
        window.Echo.channel("Hello").listen("Monitor", (e)=>{
            this.getDvr();
            console.log(e)
        })
    },
    methods: {
        getDvr() {
            let url = "/api/prision/dvr/get";
            axios.get(url)
                .then(d => {
                    this.prisions = d.data;
                    //console.log(this.prisions)
                })
                .catch(e => {
                    console.log(e.message);
                });
        },        
    }
};
</script>
