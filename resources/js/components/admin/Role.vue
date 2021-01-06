<template>
<div class="container m-0 ">    
    <b-toast title="Сообщение "   toaster="b-toaster-top-center" id="my-toast" header-class=" text-black" v-model="msg.mod" :variant="msg.variant" solid>{{msg.data}}</b-toast>
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-1">
            <div class="bg-white">
                <div class="bg-blue-500 px-4 py-3 w-full font-thin text-white text-xl">
                    <span class="w-auto">Роли</span>
                    <span class="px-3 float-right rounded-full text-center text-sm my-2 bg-gray-600">{{proData['roles'].length}}</span>
                </div>
                <div class="px-3 mt-3 py-2  bg-gray-300">
                    <button class="px-4 hover:shadow-md py-1 focus:outline-none  text-white bg-blue-400"><i class="fa fa-plus"></i></button>
                </div>
                <div class="px-4 py-2">
                    <ul class="px-4 py-3">
                        <li class="px-4 py-2 bg-gray-400 text-white  grid grid-cols-3 gap-1 divide-x divide-gray-300">
                            <span class="col-span-1 px-3">№</span>    
                            <span class="col-span-1 px-3" >Название</span>    
                            <span class="col-span-1 px-3" >Описание</span>    
                        </li>
                        <li v-for="(item, i) in proData['roles']" :key="i" class="px-4 py-2 bg-white border divide-gray-300 border-gray-300 hover:shadow-lg hover:my-3 grid grid-cols-3 gap-2">
                            <span class="col-span-1 px-3" v-text="i+1"></span>    
                            <span class="col-span-1 px-3" v-text="item.name"></span>    
                            <span class="col-span-1 px-3" v-text="item.description"></span>    
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="bg-white">
                <div class="bg-blue-500 px-4 py-3 font-thin text-white text-xl">
                <span>Полномочия</span>
                </div>
                <div class="px-4 py-2">
                    
                </div>
            </div>
        </div>
    </div>    
    <b-modal id="modal-1" v-model="modal" header-class="px-4 py-3" body-class="px-0 py-0" hide-header class="rounded-sm" no-fade hide-footer title="Добавить">
        <div class="px-4 py-4 ">
            <label for="input1" class="pt-3 text-gray-600">Название</label>
            <input type="text" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="input1">
        </div>
        <div class="bg-gray-100 px-4 py-3 w-full">
            <button class="px-4 py-3 border bg-Cyan-300 rounded-md ml-auto text-white font-bold hover:bg-blue-600 focus:shadow-lg hover:shadow-md focus:outline-none">Сохранить</button>
        </div>
    </b-modal>
</div>
</template>

<script>
    export default {
        props:[],
        data(){
            return{
                modal: true,
                proData: {'roles':[], 'permissions':[]},
                msg:{variant:'bg-green-500', mod: false, data: ''}
            }
        },
        computed:{

        },
        mounted() {
        this.RoleList()
        },
        methods: {
            RoleList(){
                axios.get("/api/users/role/list").then(d=>{
                    this.proData['roles'] = d.data.data.roles                    
                }).catch(e=>{
                    this.alert(e.message, 'danger')
                })
            },

            alert(message, variant = 'success'){
                    this.msg.mod = true;
                    this.msg.data = message
                    this.msg.variant = variant
            }

        },
    }
</script>