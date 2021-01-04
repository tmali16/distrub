<template>
  <div>
    <b-alert v-model="showAlert.mod" class="position-fixed fixed-top m-0 rounded-0" style="z-index: 2000;" :variant="showAlert.variant" dismissible>
        {{showAlert.text}}
    </b-alert>
    <b-card no-body>
      <b-tabs v-model="tabIndex" card>
        <b-tab title="Службы" :title-link-class="linkClass(0)">
            <button class="material-button mb-3" @click="openModal('service')"><i class="fa fa-edit"></i></button>
            <div class="jumbotron p-2">
                <b-table :items="retData.services" :fields="ServicesHeader" >
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(action)="data">
                            <button type="button" @click="edit('service',data.index)" class="btn btn-sm btn-outline-primary"><i class="fa fa-user-edit"></i></button>
                            <button type="button" @click="delet('service',data.index)" class="btn btn-sm  btn-outline-danger"><i class="fa fa-user-times"></i></button>
                        </template>
                </b-table>
            </div>
        </b-tab>
        <b-tab title="Типы нарушений" :title-link-class="linkClass(1)">
            <button class="material-button mb-3" @click="openModal('distrubType')"><i class="fa fa-edit"></i></button>
            <div class="jumbotron p-2 ">
                <b-table :items="retData.distrubType" :fields="DistrubTypeHeader" >
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
                    <template v-if="service.mod">
                        <div class="form-group row">
                            <label for="distrub-reg_num" class="col-md-4 col-form-label ">Полное название</label>
                            <div class="col-md-8">
                                <input type="text" v-model="service.fullname" id="service-fullname" class="form-control form-control-sm" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="distrub-reg_num" class="col-md-4 col-form-label ">Абривиатура</label>
                            <div class="col-md-8">
                                <input type="text" v-model="service.shortname" id="service-shortname" class="form-control form-control-sm" name="">
                            </div>
                        </div>

                    </template>
                    <template v-if="distrubType.mod">
                        <div class="form-group row">
                            <label for="distrubType-reg_num" class="col-md-4 col-form-label ">Название</label>
                            <div class="col-md-8">
                                <input type="text" v-model="distrubType.name" id="distrubType-name" class="form-control form-control-sm" name="">
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
                service: {
                    mod: true,
                    fullname: '',
                    shortname: '',
                },
                distrubType:{
                    mod: false,
                    name: '',
                },
                retData:{
                    services:[],
                    distrubType:[]
                },
                showAlert:{
                    mod: false,
                    variant: 'success',
                    text: '',
                }
            }
        },
        computed:{

        },
        mounted() {

            this.update();
        },
        methods: {
            linkClass(idx) {
                if (this.tabIndex === idx) {
                return ['bg-primary', 'text-light']
                } else {
                return ['bg-light', 'text-info']
                }
            },
            update(i){
                let url = "/api/directory/list";
                axios.get(url).then(d=>{
                    this.retData = d.data.data
                }).catch(e=>{
                    this.showAlert.mod = true;
                    this.showAlert.text = e.message;
                    this.showAlert.variant = 'danger';
                })
                setTimeout(() => {this.showAlert.mod = false;}, 5000);
            },
            save(){
                let url = '';
                let data = null;
                if(this.service.mod){
                    switch (this.type) {
                        case 'edit': url = '/api/directory/service/update'; break;
                        default: url = '/api/directory/service/store';break;
                    }
                    data = this.service
                }
                if(this.distrubType.mod){
                    switch (this.type) {
                        case 'edit': url = '/api/directory/distrubType/update'; break;
                        default: url = '/api/directory/distrubType/store';break;
                    }
                    data = this.distrubType;
                }
                let alert = $("#alert")
                axios.post(url, data).then(d=>{
                    if(d.data.status == 200){
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
            },
            edit(i, e){
                this.openModal(i, e)
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
            openModal(i, e=null){
                $('#MainModal').modal('show')
                if(i=='service'){
                    this.type = 'create'
                    this.distrubType.mod = false;
                    this.service.mod = true;
                    if(e != null && e >= 0){
                        this.type = 'edit'
                        this.service.fullname = this.retData.services[e].fullname
                        this.service.shortname = this.retData.services[e].shortname
                        this.service.id = this.retData.services[e].id
                    }
                }
                if(i=='distrubType'){
                    this.type = 'create'
                    this.service.mod = false;
                    this.distrubType.mod = true;
                    if(e != null && e >= 0){
                        this.type = 'edit'
                        this.distrubType.name = this.retData.distrubType[e].name
                        this.distrubType.id = this.retData.distrubType[e].id
                    }
                }
            },
            closeModal(){
                $('#MainModal').modal('hide')
                this.distrubType.mod = false;
                this.distrubType.name = '';
                this.distrubType.id = null;

                this.service.mod = false;
                this.service.fullname = '';
                this.service.shortname = '';
                this.service.id = null;
            }
        },
    }
</script>
