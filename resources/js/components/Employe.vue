<template>
<div class="">
    <div class="alert alert-success hidden" id="alert" role="alert">
    
    </div>
    <button @click="addNewEmployee" class="btn btn-sm btn-outline-success mb-3 pr-5 pl-5"><i class="fa fa-user-plus"></i></button>

    <b-table hover :items="data.data" :fields="fields" selectable
      @row-selected="onRowSelected" select-mode="single">
            <template #cell(index)="data">
                {{ data.index + 1 }}
            </template>
            <template #cell(rank)="data">
                {{ data.item.rank.name }}
            </template>
            <template #cell(action)="data">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="button" @click="editOperator(data.index)" class="btn btn-primary rounded-50"><i class="fa fa-user-edit"></i></button>
                    <button type="button" @click="deleteOperator(data.index)" class="btn btn-danger"><i class="fa fa-user-times"></i></button>
                </div>
            </template>
    </b-table>
    <pagination size="sm" align="center" :data="data" @pagination-change-page="get"></pagination>
    <b-modal v-model="addModalOpen" modal-class="animate__animated animate__zoomIn" size="lg" content-class="shadow" hide-footer title="Новый оператор" no-fade>
        <div class="form-group row">
            <label for="fname" class="col-md-4 col-form-label text-md-right">Фамилия</label>
            <div class="col-md-6">
                <input id="fname" v-model="operator.fname" type="text" class="form-control is-invalid" name="fname" required autofocus>
            </div>
            <div class="invalid-feedback">
                <span v-text="error('fname')"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>
            <div class="col-md-6">
                <input id="name" v-model="operator.name" type="text" class="form-control " name="name" required autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="lname" class="col-md-4 col-form-label text-md-right">Отчество</label>
            <div class="col-md-6">
                <input id="lname" v-model="operator.lname" type="text" class="form-control " name="lname" autocomplete="-" required autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="rankSelect" class="col-md-4 col-form-label text-md-right">Звание</label>
            <div class="col-md-6">
                <b-form-select v-model="operator.rank" size="sm" class="mt-3">                    
                    <b-form-select-option v-for="i in rankList" :key="i.id" :value="i">{{i.name}}</b-form-select-option>                    
                </b-form-select>                
            </div>
        </div>
        <div class="col-10 text-right pl-0 pr-0">
            <button class="btn btn-sm btn-primary" @click="save">Сохранить</button>
            <button class="btn btn-sm" @click="addModalOpen = false">Отмена</button>
        </div>
    </b-modal>
    <b-modal v-model="deleteModalOpen" modal-class="animate__animated animate__zoomIn" size="lg" content-class="shadow" hide-footer title="Удаеление" no-fade>
        <h3>Удалить данные {{operator.fname + " " + operator.name }}?</h3>
        <div class="col-10 text-right pl-0 pr-0">
            <button class="btn btn-sm btn-danger" @click="save">Удалить</button>
            <button class="btn btn-sm" @click="addModalOpen = false">Отмена</button>
        </div>
    </b-modal>
</div>
</template>

<script>
    export default {
        props:[],
        data(){
            return{
                addModalOpen: false,
                deleteModalOpen: false,
                data: {data:[]},
                fields:[
                    {key: 'index',label: '#',},
                    {key: 'fname',label: 'Фамилия',},
                    {key: 'name',label: 'Имя',},
                    {key: 'lname',label: 'Отчество',},
                    {key: 'rank',label: 'звание',},
                    {key: 'action',label: 'звание',},
                ],
                rankList: [],
                operator:{
                    fname: '',
                    name: '',
                    lname: '',
                    rank: 0,
                },
                errorData:[],
                type: 'create'
            }
        },
        computed:{

        },
        mounted() {
            this.get()
            $("#alert").hide()
        },
        methods: {
            get(page = 1){
                axios.get("/api/employe/list?page="+page).then(d=>{
                    this.data = d.data                    
                }).catch(e=>{
                    console.log(e)
                })
                axios.get("/api/rank/list").then(d=>{
                    this.rankList = d.data
                }).catch(e=>{
                    console.log(e)
                })
            },
            save(){
                let url = "";
                switch (this.type) {
                    case "create":
                        url = "/api/employe/add"
                        break;
                    case "edit":
                        url = "/api/employe/update";
                        break;
                    case "delete":
                        url = "/api/employe/delete";
                        break;
                    default:
                        url = "/api/employe/add";
                        break;
                }
                axios.post(url, this.operator).then(d=>{
                    if(d.data.status == 500){
                        this.errorData = d.data
                    }
                    if(d.data.status == 200){
                        $("#alert").text(d.data.data)
                        $("#alert").show()
                        setTimeout(() => {
                            $("#alert").hide()
                        }, 5000);
                        this.addModalOpen = false;
                        this.deleteModalOpen = false;
                        this.get()
                    }
                }).catch(e=>{
                    console.log(e.message)
                })
            },
            onRowSelected(items) {
                
            },
            addNewEmployee(){
                this.addModalOpen = true;
                this.type = 'create'
            },
            error(name){
                if((this.errorData.data != undefined) && (typeof this.errorData.data === 'object')){                    
                    let ret = ""
                    this.errorData.data[name].forEach(e => {
                        ret = ret+" - " +e
                    });                    
                    return ret                    
                }else{
                    return undefined;
                }
            },
            editOperator(index){
                this.type = 'edit'
                this.operator = this.data.data[index]
                this.addModalOpen = true;
            },
            deleteOperator(index){
                this.type = 'delete'
                this.operator = this.data.data[index]
                this.deleteModalOpen = true;                
            },

        },
    }
</script>
