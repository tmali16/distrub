<template>
  <div class="h-100">
    <b-alert v-model="showAlert.mod" class="position-fixed fixed-top m-0 rounded-0" style="z-index: 2000;" :variant="showAlert.variant" dismissible>
        {{showAlert.text}}
    </b-alert>
    <b-card no-body >
      <b-tabs v-model="tabIndex" card class="h-100">
         <b-tab title="Службы" :title-link-class="linkClass(0)">
            <div class="overflow-hidden sm:rounded-md">
                <div class="px-0 py-3 bg-white sm:p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-6 sm:col-span-3">
                            <button class="px-6 py-2  bg-blue-500 inline-block  border border-white hover:bg-blue-600 text-white" @click="create('service')"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <b-table :items="proData['service']" table-class="min-w-full divide-y divide-black-900" thead-tr-class="bg-blue-400 text-white" :fields="ServicesHeader" >
                                <template #cell(index)="data">
                                    {{ data.index + 1 }}
                                </template>
                                <template #cell(action)="data">
                                    <button type="button" @click="edit('service',data.index)" class="px-5 py-2 text-white bg-green-500 hover:bg-green-700"><i class="fa fa-edit"></i></button>
                                    <button type="button" @click="del('service',data.index)" class="px-5 py-2 text-white bg-red-500 hover:bg-red-700"><i class="fa fa-trash-alt"></i></button>
                                </template>
                        </b-table>
                    </div>
                </div>
            </div>
        </b-tab>
        <b-tab title="Типы нарушений" :title-link-class="linkClass(1)">
            <div class="overflow-hidden sm:rounded-md">
                <div class="px-0 py-3 bg-white sm:p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-6 sm:col-span-3">
                            <button class="px-6 py-2 bg-blue-500 inline-block  border border-white hover:bg-blue-600 text-white" @click="create('distrubType')"><i class="fa fa-edit"></i></button>
                            <select name="first_name" v-if="this.proData['distrubType'].length > 10" v-model="pageLimit" id="first_name" autocomplete="off" class="px-4 py-2 inline-block shadow-sm sm:text-sm border border-gray-900">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <b-table :items="DistrubPrison" :fields="DistrubTypeHeader" thead-tr-class="bg-blue-400 text-white">
                                <template #cell(index)="data">
                                    {{ data.index + 1 }}
                                </template>
                                <template #cell(action)="data">
                                    <button type="button" @click="edit('distrubType',data.index)" class="px-5 py-2 text-white bg-green-500 hover:bg-green-700"><i class="fa fa-edit"></i></button>
                                    <button type="button" @click="del('distrubType',data.index)" class="px-5 py-2 text-white bg-red-500 hover:bg-red-700"><i class="fa fa-trash"></i></button>
                                </template>
                        </b-table>
                    </div>
                </div>
            </div>
            <nav class="relative z-0 mt-4 inline-flex shadow-sm -space-x-px" aria-label="Pagination" v-if="this.proData['distrubType'].length > 10">
                <button @click="prevPage" :disabled="pageNumber === 0" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-900 hover:bg-blue-500">
                    <span class="sr-only">Previous</span>
                    <i class="fa fa-chevron-left"></i>
                </button>
                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{pageNumber+1}}</span>
                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{DistrubPageCount}}</span>
                <button @click="nextPage" :disabled="pageNumber >= DistrubPageCount -1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-blue-500">
                    <span class="sr-only">Previous</span>
                    <i class="fa fa-chevron-right"></i>
                </button>
            </nav>
        </b-tab>
        <b-tab title="Учреждения" :title-link-class="linkClass(2)">
            <div class="overflow-hidden sm:rounded-md">
                <div class="px-0 py-3 bg-white sm:p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-6 sm:col-span-3">
                            <button class="px-6 py-2 bg-blue-500 inline-block  border border-white hover:bg-blue-600 text-white" @click="create('prison')"><i class="fa fa-edit"></i></button>
                            <select name="first_name" v-if="this.proData['prison'].length > 10" v-model="pageLimit" id="first_name" autocomplete="off" class="px-4 py-2 inline-block shadow-sm sm:text-sm border border-gray-900">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="">
                            <table class="min-w-full divide-y divide-black-900 ">
                                <thead class="bg-gray-50 ">
                                    <tr class="bg-blue-400 text-white">
                                        <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">№</th>
                                        <th scope="col" class="px-6 py-3 text-left  font-medium text-white-500 uppercase tracking-wider">Учреждение</th>
                                        <th scope="col" class="px-6 py-3">Действие</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200 flex-grow overflow-y-auto">
                                    <tr v-for="(item, index) in pageinatedPrison" :key="index" class="bg-white border-bottom border-gray-600">
                                        <td class="px-6 py-3">{{index+1}}</td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">{{item.name}}</div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <button type="button" @click="edit('prison',item.id)" class="px-5 py-2 text-white bg-green-500 hover:bg-green-700"><i class="fa fa-edit"></i></button>
                                            <button type="button" @click="del('prison',item.id)" class="px-5 py-2 text-white bg-red-500 hover:bg-red-700"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav class="relative z-0 mt-4 inline-flex shadow-sm -space-x-px" aria-label="Pagination" v-if="this.proData['prison'].length > 9">
                                <button @click="prevPage" :disabled="pageNumber === 0" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-900 hover:bg-blue-500">
                                    <span class="sr-only">Previous</span>
                                    <!-- Heroicon name: chevron-left -->
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{pageNumber+1}}</span>
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{PrisonPageCount}}</span>
                                <button @click="nextPage" :disabled="pageNumber >= PrisonPageCount -1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-blue-500">
                                    <span class="sr-only">Previous</span>
                                    <!-- Heroicon name: chevron-left -->
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </b-tab>
        <b-tab title="Видеорег" :title-link-class="linkClass(3)">
            <div class="overflow-hidden sm:rounded-md">
                <div class="px-0 py-3 bg-white sm:p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-6 sm:col-span-3">
                            <button class="px-6 py-2 bg-blue-500 inline-block  border border-white hover:bg-blue-600 text-white" @click="create('dvr')"><i class="fa fa-edit"></i></button>
                            <select name="first_name" v-if="this.proData['dvr'].length > 10" v-model="pageLimit" id="first_name" autocomplete="off" class="px-4 py-2 inline-block shadow-sm sm:text-sm border border-gray-900">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="">
                            <table class="min-w-full divide-y divide-black-900 ">
                                <thead class="bg-gray-50 ">
                                    <tr class="bg-blue-400 text-white">
                                        <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">№</th>
                                        <th scope="col" class="px-6 py-3 text-left  font-medium text-white-500 uppercase tracking-wider">Название</th>
                                        <th scope="col" class="px-6 py-3">Учреждение</th>
                                        <th scope="col" class="px-6 py-3">ID объекта</th>
                                        <th scope="col" class="px-6 py-3">Действие</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200 flex-grow overflow-y-auto">
                                    <tr v-for="(item, index) in DvrPaginate" :key="index" class="bg-white border-bottom border-gray-600">
                                        <td class="px-6 py-3">{{index+1}}</td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">{{item.name}}</div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">{{item.prision.name}}</div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">{{item.obj_id}}</div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <button type="button" @click="edit('dvr',item.id)" class="px-5 py-2 text-white bg-green-500 hover:bg-green-700"><i class="fa fa-edit"></i></button>
                                            <button type="button" @click="del('dvr',item.id)" class="px-5 py-2 text-white bg-red-500 hover:bg-red-700"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav class="relative z-0 mt-4 inline-flex shadow-sm -space-x-px" aria-label="Pagination" v-if="this.proData['dvr'].length > 9">
                                <button @click="prevPage" :disabled="pageNumber === 0" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-900 hover:bg-blue-500">
                                    <span class="sr-only">Previous</span>
                                    <!-- Heroicon name: chevron-left -->
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{pageNumber+1}}</span>
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{PrisonPageCount}}</span>
                                <button @click="nextPage" :disabled="pageNumber >= PrisonPageCount -1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-blue-500">
                                    <span class="sr-only">Previous</span>
                                    <!-- Heroicon name: chevron-left -->
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </b-tab>
      </b-tabs>
    </b-card>
    <div class="modal animate__animated animate__zoomIn" id="MainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{type.split('.')[1] == 'update' ? 'Обновление даннах' : 'Новая запись'}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <template v-if="newDirData['service'].mod">
                        <div class="form-group row">
                            <label for="service-reg_num" class="col-md-4 col-form-label ">Полное название</label>
                            <div class="col-md-8">
                                <input type="text" v-model="newDirData['service'].fullname" id="service-fullname" class="form-control form-control-sm" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="distrub-reg_num" class="col-md-4 col-form-label ">Абривиатура</label>
                            <div class="col-md-8">
                                <input type="text" v-model="newDirData['service'].shortname" id="service-shortname" class="form-control form-control-sm" name="">
                            </div>
                        </div>

                    </template>
                    <template v-if="newDirData['distrubType'].mod">
                        <div class="form-group row">
                            <label for="distrubType-reg_num" class="col-md-4 col-form-label ">Название</label>
                            <div class="col-md-8">
                                <input type="text" v-model="newDirData['distrubType'].name" id="distrubType-name" class="form-control form-control-sm" name="">                                
                            </div>                            
                        </div>
                    </template>
                    <template v-if="newDirData['prison'].mod">
                        <div class="form-group row">
                            <label for="prison-reg_num" class="col-md-4 col-form-label ">Название </label>
                            <div class="col-md-8">
                                <input type="text" v-model="newDirData['prison'].name" id="prison-name" class="form-control form-control-sm" name="">
                            </div>
                        </div>
                    </template>
                    <template v-if="newDirData['dvr'].mod">
                        <div class="form-group row">
                            <label for="dvr-name" class="col-md-4 col-form-label ">Название </label>
                            <div class="col-md-8">
                                <input type="text" v-model="newDirData['dvr'].name" id="dvr-name" class="form-control form-control-sm" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dvr-obj_id" class="col-md-4 col-form-label ">ID объекта </label>
                            <div class="col-md-8">
                                <input type="number" v-model="newDirData['dvr'].obj_id" id="dvr-obj_id" class="form-control form-control-sm" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dvr-prision" class="col-md-4 col-form-label ">Учреждение </label>
                            <div class="col-md-8">
                                <select v-model="newDirData['dvr'].prision" id="dvr-obj_id" class="form-control form-control-sm" name="">
                                    <option v-for="(p, o) in proData['prison']" :key="o" :value="p" v-text="p.name"></option>
                                </select>                                
                            </div>
                        </div>
                    </template>
                    <div class="form-group row justify-content-end">
                        <div class="col-md-3">
                            <button class="btn btn-sm btn-success" @click="save">Сохранить</button>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-sm" @click="closeModal">Отмена</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
    export default {
        props:[],
        data(){
            return{
                tabIndex: 0,
                ServicesHeader:[{key: "index",label: "№"},{key: "fullname",label: "Полное название"},{key: "shortname",label: "Абривиатура"},{key: "action",label: "Действие"},],
                DistrubTypeHeader:[{key: "index",label: "№"},{key: "name",label: "Название"},{key: "action",label: "Действие"},],
                type:'',
                url: "",
                sendData: {},
                pageLimit: 10,
                pageNumber: 0,
                newDirData:{
                    'service': {
                        mod: true,
                        fullname: '',
                        shortname: '',
                    },
                    'distrubType':{
                        mod: false,
                        name: 'a',
                    },
                    'prison':{
                        mod: false,
                        name: '',
                    },
                    'dvr':{
                        mod: false,
                        name: '',
                        obj_id: '',
                        prision: '',
                    }
                },
                showAlert:{
                    mod: false,
                    variant: 'success',
                    text: '',
                },
                proData: {
                    'service':[],
                    'distrubType':[],
                    'prison':[],
                    'dvr':[]
                }
            }
        },
        computed:{
            PrisonPageCount(){
                let l = this.proData['prison'].length,
                s= this.pageLimit
                return Math.ceil(l/s);
            },
            pageinatedPrison(){
                const start = this.pageNumber * this.pageLimit,
                end = start + this.pageLimit;
                return this.proData['prison'].slice(start, end)
            },
            DistrubPageCount(){
                let l = this.proData['distrubType'].length,
                s= this.pageLimit
                return Math.ceil(l/s);
            },
            DistrubPrison(){
                const start = this.pageNumber * this.pageLimit,
                end = start + this.pageLimit;
                return this.proData['distrubType'].slice(start, end)
            },
            DvrPageCount(){
                let l = this.proData['dvr'].length,
                s= this.pageLimit
                return Math.ceil(l/s);
            },
            DvrPaginate(){
                const start = this.pageNumber * this.pageLimit,
                end = start + this.pageLimit;
                return this.proData['dvr'].slice(start, end)
            }
        },
        mounted() {
            this.list();
            this.PrisionList();
        },
        methods: {
            linkClass(idx){
                if (this.tabIndex === idx) {
                return ['bg-primary', 'text-white']
                } else {
                return ['bg-light', 'text-info']
                }
            },
            nextPage(){
                this.pageNumber++;
            },
            prevPage(){
                this.pageNumber--;
            },
            list(i){
                let url = "/api/directory/list";
                axios.get(url).then(d=>{
                    this.retData = d.data.data
                    this.proData['service'] = d.data.data.services;
                    this.proData['distrubType'] = d.data.data.distrubType;
                    this.proData['dvr'] = d.data.data.dvr;
                }).catch(e=>{
                    this.showAlert.mod = true;
                    this.showAlert.text = e.message;
                    this.showAlert.variant = 'danger';
                })
                setTimeout(() => {this.showAlert.mod = false;}, 5000);
            },
            PrisionList(){
                let url = "/api/directory/prison/all";
                axios.get(url).then(d=>{
                    this.proData['prison'] = d.data
                }).catch(e=>{
                    this.showAlert.mod = true;
                    this.showAlert.text = e.message;
                    this.showAlert.variant = 'danger';
                })
                setTimeout(() => {this.showAlert.mod = false;}, 5000);
            },
            save(){
                let tip = this.type.split('.')
                this.sendData = this.newDirData[tip[0]]                
                
                axios.post(this.url, this.sendData).then(d=>{
                    if(d.data.status == 200){
                        this.showAlert.variant = 'success';
                        this.showAlert.mod = true;
                        this.showAlert.text = d.data.data;
                        this.closeModal()
                    }else{
                        this.showAlert.mod = true;
                        this.showAlert.text = d.data.data;
                        this.showAlert.variant = 'danger';
                    }
                    this.list();
                    this.PrisionList();
                }).catch(e=>{
                    this.showAlert.mod = true;
                    this.showAlert.text = e.message;
                    this.showAlert.variant = 'danger';
                })
            },
            create(path, index = null){
                this.url = "/api/directory/"+path+"/create";
                this.type = path+'.create.'+index;
                this.ModalOpen();
                
            },
            edit(path, index = null){
                let url = "/api/directory/"+path+"/update";
                this.type = path+'.update.'+index;
                this.ModalOpen();
            },
            del(path, index){
                this.url = "/api/directory/"+path+"/delete";
                this.type = path+'.delete.'+index;
                let res = confirm("Вы действительно хотите удалить данную запись?")
                if(res){
                    let tip = this.type.split(".");
                    let ind = index
                    if (path == 'prison' || path == 'dvr') {
                        ind = this.proData[path].findIndex(k=>k.id == index)
                    }
                    this.newDirData[tip[0]] = this.proData[tip[0]][ind]
                    this.save()
                }
            },
            ModalOpen(){
                let tip = this.type.split('.')
                let modal = $('#MainModal')
                this.url = "/api/directory/"+tip[0]+'/'+tip[1];
                modal.modal('show')
                switch (tip[0]) {
                    case 'service':
                        this.newDirData['distrubType'].mod = false;
                        this.newDirData['service'].mod = true;
                        this.newDirData['prison'].mod = false;
                        if (tip[1] == 'update') {
                            this.newDirData[tip[0]].fullname = this.proData[tip[0]][tip[2]].fullname
                            this.newDirData[tip[0]].shortname = this.proData[tip[0]][tip[2]].shortname
                            this.newDirData[tip[0]].id = this.proData[tip[0]][tip[2]].id
                        }
                        break;
                    case 'distrubType':                        
                        this.newDirData['service'].mod = false;
                        this.newDirData['prison'].mod = false;
                        this.newDirData['distrubType'].mod = true;
                        
                        if (tip[1] == 'update') {
                            this.newDirData[tip[0]].name = this.proData[tip[0]][tip[2]].name
                            this.newDirData[tip[0]].id = this.proData[tip[0]][tip[2]].id
                        }
                        break;
                    case 'prison':
                        this.newDirData['service'].mod = false;
                        this.newDirData['distrubType'].mod = false;
                        this.newDirData['prison'].mod = true;
                        if (tip[1] == 'update') {
                            let ind = this.proData[tip[0]].findIndex(k=>k.id == tip[2])
                            this.newDirData[tip[0]].name = this.proData[tip[0]][ind].name
                            this.newDirData[tip[0]].id = this.proData[tip[0]][ind].id
                        }
                        break;
                    case 'dvr':
                        this.newDirData['service'].mod = false;
                        this.newDirData['distrubType'].mod = false;
                        this.newDirData['prison'].mod = false;
                        this.newDirData['dvr'].mod = true;
                        if (tip[1] == 'update') {
                            let ind = this.proData[tip[0]].findIndex(k=>k.id == tip[2])
                            this.newDirData[tip[0]].name = this.proData[tip[0]][ind].name
                            this.newDirData[tip[0]].obj_id = this.proData[tip[0]][ind].obj_id
                            this.newDirData[tip[0]].prision = this.proData[tip[0]][ind].prision
                            this.newDirData[tip[0]].id = this.proData[tip[0]][ind].id
                        }
                        break;
                    

                }
            },
            closeModal(){
                $('#MainModal').modal('hide')
                this.newDirData['distrubType'].mod = false;
                this.newDirData['distrubType'].name = '';
                this.newDirData['distrubType'].id = null;
                this.type = '';
                this.newDirData['service'].mod = false;
                this.newDirData['service'].fullname = '';
                this.newDirData['service'].shortname = '';
                this.newDirData['service'].id = null;
                this.newDirData['prison'].mod = false;
                this.newDirData['prison'].name = '';
                this.newDirData['prison'].id = null;

                this.newDirData['dvr'].id = null;
                this.newDirData['dvr'].name = '';
                this.newDirData['dvr'].obj_id = '';
                this.newDirData['dvr'].prision = null;
                this.newDirData['dvr'].mod = false;
            }
        },
    }
</script>
