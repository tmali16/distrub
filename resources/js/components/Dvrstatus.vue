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
        this.getDvr();
        window.Echo.channel("Hello").listen("Monitor", (e)=>{
            this.getDvr();
            console.log(e)
        })
    },
    methods: {
        getDvr() {
            let url = "/api/prision/dvr/get";
            axios
                .get(url)
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
