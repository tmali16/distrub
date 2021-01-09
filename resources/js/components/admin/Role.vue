<template>
<div class="container m-0 ">
    <b-toast title="Сообщение "   toaster="b-toaster-top-center" id="my-toast" header-class=" text-black" v-model="msg.mod" :variant="msg.variant" solid>{{msg.data}}</b-toast>
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-1">
            <div class="bg-white ">
                <div class="bg-blue-500 px-4 py-3 w-full font-thin text-white text-xl">
                    <span class="w-auto">Роли</span>
                    <span class="px-3 float-right rounded-full text-center text-sm my-2 bg-gray-600">{{proData['role'].length}}</span>
                </div>
                <div class="px-3 mt-3 py-3   flex flex-row">
                    <button @click="create('role')" :disabled="!canMethod['role'].create" :class="canMethod['role'].create ? 'hover:shadow-md bg-blue-500 ' : 'bg-gray-700 text-gray-400'" class="mx-4  focus:outline-none   text-white rounded-md h-6 w-9 flex items-center justify-center"><i class="fa fa-plus"></i></button>
                    <button @click="update('role', canMethod['role'].id)" :disabled="!canMethod['role'].edit" :class="canMethod['role'].edit ? ' bg-cyan-300  text-white ' : 'bg-gray-700 text-gray-400'" class="mx-4 focus:outline-none rounded-md h-6 w-9 flex items-center justify-center"><i class="fa fa-pencil-alt"></i></button>
                    <button @click="delet('role', canMethod['role'].id)" :disabled="!canMethod['role'].delet" :class="canMethod['role'].delet ? ' bg-red-500  text-white ' : 'bg-gray-700 text-gray-400'" class="mx-4 focus:outline-none rounded-md h-6 w-9 flex items-center justify-center"><i class="fa fa-trash"></i></button>
                </div>
                <div class=" py-2">
                    <div class="accordion">
                        <div class="border-bottom border-white text-white"  v-for="(item, i) in proData['role']" :key="i">
                            <div class="text-black border-b-4 border-t-4 ">
                                <button class="w-full px-4 py-3 grid grid-cols-5 focus:outline-none"
                                        @click="collapse('contentRole'+item.id, 'role', item.slug, item.id)">
                                        <span class="py-2 col-start-1 text-left col-span-3 font-bold">{{item.name}}</span>
                                        <div class="col-span-1 py-2">
                                            <span class="py-2 bg-gray-200 px-4 rounded-xl">Уровень {{item.level}}</span>
                                        </div>
                                        <div class="py-2 text-white">
                                            <span class="py-1 bg-green-400 px-4 rounded-lg">{{item.users.length}} User</span>
                                            <span class="py-1  bg-gray-400 px-4 rounded-lg">{{item.permissions.length}} Perm</span>
                                        </div>
                                </button>
                            </div>
                            <b-collapse :id="'contentRole'+item.id" is-nav class="py-2">
                                <table class="min-w-full divide-y divide-black-900 text-black">
                                    <thead class="bg-gray-50 ">
                                        <tr class="bg-blue-400 text-white">
                                            <th scope="col" class="px-6 py-2 text-left font-medium text-white-500 uppercase tracking-wider">ФИО</th>
                                            <th scope="col" class="px-6 py-2 text-left font-medium text-white-500 uppercase tracking-wider">Имя пользователя</th>
                                            <th scope="col" class="px-6 py-2 text-left font-medium text-white-500 uppercase tracking-wider">Полномочия</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-200 flex-grow overflow-y-auto">
                                        <tr v-for="p in item.users" :key="p.id" class="bg-white border-bottom border-gray-600">
                                            <td class="px-6 py-3" v-text="p.name"></td>
                                            <td class="px-6 py-3" v-text="p.username"></td>
                                            <td class="px-6 py-3">
                                                <span class="px-4 pb-1 mr-1 mb-1 bg-cyan-300 text-white rounded-md" v-for="(p, i) in item.permissions" :key="i">
                                                    {{p.slug}}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </b-collapse>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 ">
            <div class="bg-white">
                <div class="bg-blue-500 px-4 py-3 font-thin text-white text-xl">
                    <span>Полномочия</span>
                    <span class="px-3 float-right rounded-full text-center text-sm my-2 bg-gray-600">{{proData['permission'].length}}</span>
                </div>
                <div class="px-3 mt-3 py-3  bg-gray-200 flex flex-row">
                    <button @click="create('permission')" :disabled="!canMethod['permission'].create" :class="canMethod['permission'].create ? 'hover:shadow-md bg-blue-500 ' : 'bg-gray-700 text-gray-400'" class="mx-4  focus:outline-none   text-white rounded-md h-6 w-9 flex items-center justify-center"><i class="fa fa-plus"></i></button>
                    <button @click="update('permission', canMethod['permission'].id)" :disabled="!canMethod['permission'].edit" :class="canMethod['permission'].edit ? ' bg-cyan-300  text-white ' : 'bg-gray-700 text-gray-400'" class="mx-4 focus:outline-none rounded-md h-6 w-9 flex items-center justify-center"><i class="fa fa-pencil-alt"></i></button>
                    <button @click="delet('permission', canMethod['permission'].id)" :disabled="!canMethod['permission'].delet" :class="canMethod['permission'].delet ? ' bg-red-500  text-white ' : 'bg-gray-700 text-gray-400'" class="mx-4 focus:outline-none rounded-md h-6 w-9 flex items-center justify-center"><i class="fa fa-trash"></i></button>
                </div>
                <div class="py-2 overflow-auto" style="height: 630px">
                    <div class="accordion ">
                        <div class="border-bottom border-white text-white"  v-for="(item, i) in proData['permission']" :key="i">
                            <div class="bg-blue-500">
                                <button class="w-full px-4 py-3 flex flex-row justify-between hover:bg-blue-600 focus:outline-none" @click="collapse('contentPermission'+item.id, 'permission', item.slug, item.id)">
                                    <span class="py-2">{{item.name}}</span>
                                    <div class="py-2">
                                        <span class="py-1  bg-green-400 px-2 rounded-lg">{{item.roles.length}} Роли</span>
                                        <span class="py-1  bg-gray-400 px-2 rounded-lg">{{item.users.length}} Польз.</span>
                                    </div>
                                </button>
                            </div>
                            <b-collapse :id="'contentPermission'+item.id" class="py-3 px-4">
                                {{item.name}}
                            </b-collapse>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <b-modal id="modal-1" v-model="modal" size="lg" no-close-on-backdrop header-class="px-4 py-3"  body-class="px-0 py-0"
        modal-class="animate__animated animate__slideInDown animate__fast" hide-header class="rounded-sm" hide-footer title="Добавить">
        <template v-if="newData['role'].mod && type.split('.')[1] != 'delete'">
            <div class="px-4 py-4 grid grid-cols-2 gap-2">
                <div class="col-span-1">
                    <label for="input1" class="pt-3 text-gray-600">Название</label>
                    <input type="text" v-model="newData['role'].name" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="input1">
                    <label for="input2" class="pt-3 text-gray-600">Слуг</label>
                    <input type="text" v-model="newData['role'].slug" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="input2">
                    <label for="input3" class="pt-3 text-gray-600">Описание</label>
                    <textarea v-model="newData['role'].description" id="input3" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" cols="5" rows="3"></textarea>
                </div>
                <div class="col-span-1">
                    <label for="select1" class="pt-3 text-gray-600">Уровень</label>
                    <div class="relative">
                        <select v-model="newData['role'].level" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none block appearance-none w-full" id="select1">
                            <option value="0">Уровень 0</option>
                            <option value="1">Уровень 1</option>
                            <option value="2">Уровень 2</option>
                            <option value="3">Уровень 3</option>
                            <option value="4">Уровень 4</option>
                            <option value="5">Уровень 5</option>
                        </select>
                        <div class="absolute flex inset-y-0 items-center px-4 right-0 text-white rounded-r-md bg-blue-500 pointer-events-none">
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="">
                        <label for="select1" class="pt-3 text-gray-600">Полномочия</label>
                        <v-select multiple v-model="newData['role'].permissions" label="slug" :options="proData['permission']" inputId="vSelectId" class="border-0">
                            <template #option="{ name }">
                                {{name}}
                            </template>
                        </v-select>
                    </div>
                </div>
            </div>
        </template>
        <template v-if="newData['permission'].mod && type.split('.')[1] != 'delete'">
            <div class="px-4 py-4 ">
                <label for="input4" class="pt-3 text-gray-600">Название</label>
                <input type="text" v-model="newData['permission'].name" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="input4">
                <label for="input5" class="pt-3 text-gray-600">Слуг</label>
                <input type="text" v-model="newData['permission'].slug" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="input5">
                <label for="input1" class="pt-3 text-gray-600">Описание</label>
                <input type="text"  v-model="newData['permission'].description" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="input6">
                <label for="input6" class="pt-3 text-gray-600">Модель</label>
                <div class="relative">
                    <select v-model="newData['permission'].model" class="px-4 py-3 bg-gray-200 rounded-md focus:outline-none w-full" id="">
                        <option value="Permission">PERMISSION</option>
                        <option value="Role">ROLE</option>
                        <option v-for="i in proData['models']" :key="i" :value="i" v-text="i"></option>
                    </select>
                    <div class="absolute flex inset-y-0 items-center px-4 right-0 text-white rounded-r-md bg-blue-500 pointer-events-none">
                        <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
        </template>
        <template v-if="type != null && type.split('.')[1] == 'delete'">
            <div class="px-5 py-5 grid grid-cols-5">
                <div class="col-span-1 text-red-500">
                    <i class="fa fa-exclamation-triangle text-2xl"></i>
                </div>
                <div class="col-span-4">
                    <h1 class="text-red-400 text-xl">ВНИМАНИЕ!</h1>
                    <h2 class="text-red-500 text-md">Вы действительно хотите удалить данную запись?</h2>
                </div>
            </div>

        </template>
        <div class="flex justify-end bg-gray-100 px-4 py-3 w-full">
            <template v-if="type != null && type.split('.')[1] == 'delete'">
                <button @click="Save()" class="px-4 py-3 border bg-red-500 inline-block rounded-md mx-3 text-white font-bold hover:bg-red-600 focus:shadow-lg hover:shadow-md focus:outline-none">Удалить</button>
            </template>
            <template v-else>
                <button @click="Save()" class="px-4 py-3 border bg-cyan-500 inline-block rounded-md mx-3 text-white font-bold hover:bg-blue-600 focus:shadow-lg hover:shadow-md focus:outline-none">Сохранить</button>
            </template>
            <button @click="CloseModal()" class="px-4 py-3 bg-gray-300 inline-block rounded-md mx-3 text-gray-50 font-bold hover:bg-gray-300 focus:shadow-lg hover:shadow-md focus:outline-none">Отмена</button>
        </div>
    </b-modal>
</div>
</template>

<script>
import vSelect from 'vue-select'
    export default {
        components:{
            vSelect
        },
        props:[],
        data(){
            return{
                modal: false,
                url: '',
                proData: {'role':[], 'permission':[], 'models':[]},
                newData: {'role': {mod:false,name:'', slug:'',description:'',level:0, permission:[]}, 'permission':{mod:false,name:'', slug:'',description:'',model:''}},
                userHeader:[{key:'name', label:'Имя пользователя'},{key:'username', label:'Имя пользователя'},{key:'permission', label:'Полномочия'}],
                sendData:{},
                type: '',
                canMethod: {'role':{edit:false, create:true, delet:false, id: null},'permission':{edit:false, create:true, delet:false, id: null},},
                msg:{variant:'bg-green-500', mod: false, data: ''}
            }
        },
        computed:{
        },
        mounted() {
            this.List()
        },
        methods: {
            List(){
                axios.get("/api/users/role/list").then(d=>{
                    this.proData['role'] = d.data.data.roles
                    this.proData['permission'] = d.data.data.permissions
                    this.proData['models'] = d.data.data.models
                    console.log(d.data.data.roles)
                }).catch(e=>{
                    this.alert(e.message, 'danger')
                })
            },
            Save(){
                let tip = this.type.split('.');
                this.sendData = this.newData[tip[0]]
                axios.post(this.url, this.sendData).then(d=>{
                    if(d.data.status == 200){
                        this.alert(d.data.data, 'success')
                        this.List()
                        this.CloseModal()
                    }else{
                        this.alert(d.data.data, 'danger')
                    }
                }).catch(e=>{
                    this.alert(e.message, 'danger')
                })
            },
            create(path, id = null){
                this.url = '/api/users/role/create';
                this.type = path +'.create.'+id
                this.OpenModal()
            },
            update(path, id =null){
                this.url = "/api/users/role/update";
                this.type = path+'.update.'+id;
                this.OpenModal()
            },
            select(path, slug, id){
                if (slug == 'admin') {
                    this.canMethod[path].delet = false
                } else {
                    this.canMethod[path].delet = true
                }
                this.canMethod[path].edit = true
                this.canMethod[path].create = true
                this.canMethod[path].id = id
            },
            delet(path, id){
                this.url = "/api/users/role/delete";
                this.type = path+'.delete.'+id;
                this.OpenModal()
            },
            OpenModal(){
                this.modal = true;
                let tip = this.type.split('.')
                this.newData[tip[0]].mod = true
                if (tip[1] == 'update' || tip[1] == 'delete') {
                    const ind = this.proData[tip[0]].findIndex(i=>i.id == tip[2])
                    this.newData[tip[0]] = this.proData[tip[0]][ind]
                    this.newData[tip[0]].mod = true
                }
            },
            CloseModal(){
                this.modal = false;
                this.resetData()
            },
            resetData(){

                this.newData['role'].name = '';
                this.newData['role'].slug = '';
                this.newData['role'].description = '';
                this.newData['role'].level = '';
                this.newData['role'].mod = false;
                this.newData['role'].id = null;

                this.newData['permission'].name = '';
                this.newData['permission'].slug = '';
                this.newData['permission'].description = '';
                this.newData['permission'].model = '';
                this.newData['permission'].mod = false;
                this.newData['permission'].id = null;
                this.canMethod['role'].edit = false;
                this.canMethod['permission'].edit = false;
                this.canMethod['role'].create = true;
                this.canMethod['permission'].create = true;
                this.canMethod['role'].delete = false;
                this.canMethod['permission'].delete = false;
                this.canMethod['role'].id = null;
                this.canMethod['permission'].id = null;
                this.List()

            },
            collapse(idCollapse, path, slug, id){
                this.$root.$emit('bv::toggle::collapse', idCollapse);

                if(this.canMethod['role'].id != null || this.canMethod['permission'].id != null){
                    this.canMethod['role'].edit = false;
                    this.canMethod['permission'].edit = false;
                    this.canMethod['role'].create = true;
                    this.canMethod['permission'].create = true;
                    this.canMethod['role'].delete = false;
                    this.canMethod['permission'].delete = false;
                    this.canMethod['role'].id = null;
                    this.canMethod['permission'].id = null;
                }else{
                this.select(path, slug, id)
                }
            },
            alert(message, variant = 'success'){
                    this.msg.mod = true;
                    this.msg.data = message
                    this.msg.variant = variant
            }

        },
    }
</script>

