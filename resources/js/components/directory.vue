<template>
  <div>
    <b-alert v-model="showAlert.mod" class="position-fixed fixed-top m-0 rounded-0" style="z-index: 2000;" :variant="showAlert.variant" dismissible>
        {{showAlert.text}}
    </b-alert>
    <b-card no-body>
      <b-tabs v-model="tabIndex" card>
         <b-tab title="Службы" :title-link-class="linkClass(0)">
            <button class="material-button mb-3" @click="create('service')"><i class="fa fa-edit"></i></button>
            <div class="jumbotron p-2">
                <b-table :items="proData['service']" :fields="ServicesHeader" >
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(action)="data">
                            <button type="button" @click="edit('service',data.index)" class="btn btn-sm btn-outline-primary"><i class="fa fa-user-edit"></i></button>
                            <button type="button" @click="del('service',data.index)" class="btn btn-sm  btn-outline-danger"><i class="fa fa-user-times"></i></button>
                        </template>
                </b-table>
            </div>
        </b-tab>
        <b-tab title="Типы нарушений" :title-link-class="linkClass(1)">
            <button class="material-button mb-3" @click="create('distrubType')"><i class="fa fa-edit"></i></button>
            <div class="jumbotron p-2 ">
                <b-table :items="proData['distrubType']" :fields="DistrubTypeHeader" >
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(action)="data">
                            <button type="button" @click="edit('distrubType',data.index)" class="btn btn-sm btn-outline-primary"><i class="fa fa-user-edit"></i></button>
                            <button type="button" @click="delet('distrubType',data.index)" class="btn btn-sm  btn-outline-danger"><i class="fa fa-user-times"></i></button>
                        </template>
                </b-table>
            </div>
        </b-tab>
        <b-tab title="Учреждения" :title-item-class="linkClass(2)">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium inline-block text-gray-700">First name</label>
                            <select name="first_name" id="first_name" autocomplete="off" class="px-3 py-2 inline-block focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm border-4 border-gray-300">
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">                
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">                    
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200">                            
                            <table class="min-w-full divide-y divide-black-900">
                                <thead class="bg-gray-50">
                                    <tr class="bg-blue-400 text-white">
                                        <th scope="col" class="px-6 py-3 text-left font-medium text-white-500 uppercase tracking-wider">№</th>
                                        <th scope="col" class="px-6 py-3 text-left  font-medium text-white-500 uppercase tracking-wider">Учреждение</th>                                        
                                        <th scope="col" class="px-6 py-3">Действие</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                    <tr v-for="(item, index) in prisons.data" :key="index" class="bg-white border-4 border-gray-300">
                                        <td class="px-6 py-3">{{index+1}}</td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">{{item.name}}</div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <button type="button" @click="edit('prisons',data.index)" class="px-4 py-1 text-white bg-blue-600 shadow-md hover:shadow-md"><i class="fa fa-user-edit"></i></button>
                                            <button type="button" @click="delet('prisons',data.index)" class="px-4 py-1 text-white bg-red-600 shadow-md hover:shadow-md"><i class="fa fa-user-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <h6 class="modal-title">Modal title</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <template v-if="newData['service'].mod">
                        <div class="form-group row">
                            <label for="distrub-reg_num" class="col-md-4 col-form-label ">Полное название</label>
                            <div class="col-md-8">
                                <input type="text" v-model="newData['service'].fullname" id="service-fullname" class="form-control form-control-sm" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="distrub-reg_num" class="col-md-4 col-form-label ">Абривиатура</label>
                            <div class="col-md-8">
                                <input type="text" v-model="newData['service'].shortname" id="service-shortname" class="form-control form-control-sm" name="">
                            </div>
                        </div>

                    </template>
                    <template v-if="newData['distrubType'].mod">
                        <div class="form-group row">
                            <label for="distrubType-reg_num" class="col-md-4 col-form-label ">Название</label>
                            <div class="col-md-8">
                                <input type="text" v-model="newData['distrubType'].name" id="distrubType-name" class="form-control form-control-sm" name="">
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
                prisons: {
                        data:[]
                    },
                retData:{
                    services:[],
                    distrubType:[],                    
                },
                newData:{
                    'service': {
                        mod: true,
                        fullname: '',
                        shortname: '',
                    },
                    'distrubType':{
                        mod: false,
                        name: '',
                    },
                },
                showAlert:{
                    mod: false,
                    variant: 'success',
                    text: '',
                },
                proData: {
                    'service':[],
                    'distrubType':[]
                }
            }
        },
        computed:{

        },
        mounted() {
            this.list();
            this.PrisionList();
        },
        methods: {
            linkClass(idx){
                if (this.tabIndex === idx) {
                return ['bg-primary', 'text-light']
                } else {
                return ['bg-light', 'text-info']
                }
            },
            list(i){
                let url = "/api/directory/list";
                axios.get(url).then(d=>{
                    this.retData = d.data.data                    
                    this.proData['service'] = d.data.data.services;
                    this.proData['distrubType'] = d.data.data.distrubType;                    
                }).catch(e=>{
                    this.showAlert.mod = true;
                    this.showAlert.text = e.message;
                    this.showAlert.variant = 'danger';
                })
                setTimeout(() => {this.showAlert.mod = false;}, 5000);
            },
            PrisionList(page=1){
                let url = "/api/prison/get?page="+page;
                axios.get(url).then(d=>{
                    this.prisons = d.data
                }).catch(e=>{
                    this.showAlert.mod = true;
                    this.showAlert.text = e.message;
                    this.showAlert.variant = 'danger';
                })
                setTimeout(() => {this.showAlert.mod = false;}, 5000);
            },
            save(){
                let tip = this.type.split('.')                
                this.sendData = this.newData[tip[0]]                
                axios.post(this.url, this.sendData).then(d=>{
                    if(d.data.status == 200){
                        this.showAlert.mod = true;
                        this.showAlert.text = d.data.data;
                        this.closeModal()
                    }else{
                        this.showAlert.mod = true;
                        this.showAlert.text = d.data.data;
                        this.showAlert.variant = 'danger';
                    }
                    this.list();
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
            delet(i,e){
                let res = confirm("Вы действительно хотите удалить данную запись?")
                if(res){
                    let url = "";
                    let data = null;
                    if(i=='service' && e != null && e >= 0){
                        this.distrubType.mod = false;
                        this.service.mod = true;
                        this.type = 'delete'
                        this.service.id = this.retData.services[e].id
                        url = "/api/directory/service/delete";
                        data = this.service;
                    }
                    if(i=='distrubType'&& e != null && e >= 0){
                        this.service.mod = false;
                        this.distrubType.mod = true;
                        this.type = 'delete';
                        this.distrubType.id = this.retData.distrubType[e].id;
                        url = "/api/directory/distrubType/delete";
                        data = this.distrubType;
                    }
                        axios.post(url, data).then(d=>{
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
                        this.update();
                    }).catch(e=>{
                        this.showAlert.mod = true;
                        this.showAlert.text = e.message;
                        this.showAlert.variant = 'danger';
                    })
                }
            },
            del(path, index){
                let url = "/api/directory/"+path+"/delete";
                this.type = path+'.delete.'+index;
                let res = confirm("Вы действительно хотите удалить данную запись?")
                if(res){
                    let tip = this.type.split(".");
                    this.newData[tip[0]][index]
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
                        this.newData['distrubType'].mod = false;
                        this.newData['service'].mod = true;
                        if (tip[1] == 'update') {
                            this.newData[tip[0]].fullname = this.proData[tip[0]][tip[2]].fullname
                            this.newData[tip[0]].shortname = this.proData[tip[0]][tip[2]].shortname
                            this.newData[tip[0]].id = this.proData[tip[0]][tip[2]].id
                        }
                        break;
                    case 'distrubType':
                        this.newData['service'].mod = false;
                        this.newData['distrubType'].mod = true;
                        if (tip[1] == 'update') {
                            this.newData[tip[0]].name = this.proData[tip[0]][tip[2]].name
                            this.newData[tip[0]].id = this.proData[tip[0]][tip[2]].id
                        }
                        break;
                }
            },
            openModal(path, index=null){
                $('#MainModal').modal('show')
                // if(path=='service'){
                //     // this.type = 'create'
                //     this.distrubType.mod = false;
                //     this.service.mod = true;
                //     if(index != null && index >= 0){
                //         this.type = 'edit'
                //         this.service.fullname = this.retData.services[e].fullname
                //         this.service.shortname = this.retData.services[e].shortname
                //         this.service.id = this.retData.services[e].id
                //     }
                // }
                // if(path=='distrubType'){
                //     this.type = 'create'
                //     this.service.mod = false;
                //     this.distrubType.mod = true;
                //     if(index != null && index >= 0){
                //         this.type = 'edit'
                //         this.distrubType.name = this.retData.distrubType[e].name
                //         this.distrubType.id = this.retData.distrubType[e].id
                //     }
                // }                
            },
            closeModal(){
                $('#MainModal').modal('hide')                
                this.newData['distrubType'].mod = false;
                this.newData['distrubType'].name = '';
                this.newData['distrubType'].id = null;
                this.type = '';
                this.newData['service'].mod = false;
                this.newData['service'].fullname = '';
                this.newData['service'].shortname = '';
                this.newData['service'].id = null;
            }
        },
    }
</script>
