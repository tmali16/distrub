<template>
<div class="">
    <div class="alert alert-success hidden" id="alert" role="alert">

    </div>
    <div class="overflow-hidden sm:rounded-md">
        <div class="px-0 py-3 bg-white sm:p-6">
            <div class="grid grid-cols-2 gap-2">
                <div class="col-span-6 sm:col-span-3">
                    <button class="px-6 py-2 bg-blue-500 inline-block  border border-white hover:bg-blue-600 text-white" @click="addNewEmployee"><i class="fa fa-user-plus"></i></button>

                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <b-table :items="data.data" :fields="fields"
                @row-selected="onRowSelected" select-mode="single" thead-tr-class="bg-blue-400 text-white">
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(rank)="data">
                            {{ data.item.rank.name }}
                        </template>
                        <template #cell(action)="data">
                            <button type="button" @click="editOperator(data.index)" class="px-5 py-2 text-white bg-green-500 hover:bg-green-700"><i class="fa fa-user-edit"></i></button>
                            <button type="button" @click="deleteOperator(data.index)" class="px-5 py-2 text-white bg-red-500 hover:bg-red-700"><i class="fa fa-user-times"></i></button>
                        </template>
                </b-table>
            </div>
        </div>
    </div>
    <pagination align="center" :data="data" @pagination-change-page="get"></pagination>


    <div class="modal animate__animated animate__zoomIn"  id="ModalEmploye" tabindex="-1" role="dialog" aria-labelledby="ModalEmploye" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 pr-3 pl-3">
                    <h4 class="modal-title">Новый оператор</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="fname" class="col-md-4 col-form-label text-md-right">Фамилия</label>
                        <div class="col-md-6">
                            <input id="fname" v-model.trim="$v.operator.fname.$model" type="text" class="form-control form-control-sm" name="fname" autocomplete="off" required autofocus>
                            <div class="error-invalid" v-if="$v.operator.fname.$error && !$v.operator.fname.required" >Заполните поле</div>
                        </div>
                        <div class="invalid-feedback">
                            <span v-text="error('fname')"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>
                        <div class="col-md-6">
                            <input id="name" v-model.trim="$v.operator.name.$model" type="text" class="form-control form-control-sm" name="name" autocomplete="off" required>
                            <div class="error-invalid" v-if="$v.operator.name.$error && !$v.operator.name.required" >Заполните поле</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-md-4 col-form-label text-md-right">Отчество</label>
                        <div class="col-md-6">
                            <input id="lname" v-model.trim="$v.operator.lname.$model" type="text" class="form-control form-control-sm" name="lname" autocomplete="off" required>
                            <div class="error-invalid" v-if="$v.operator.lname.$error && !$v.operator.lname.required" >Заполните поле</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rankSelect" class="col-md-4 col-form-label text-md-right">Звание</label>
                        <div class="col-md-6">
                            <b-form-select v-model.trim="$v.operator.rank.$model" size="sm" class="mt-3">
                                <b-form-select-option v-for="i in rankList" :key="i.id" :value="i">{{i.name}}</b-form-select-option>
                            </b-form-select>
                            <div class="error-invalid" v-if="$v.operator.rank.$error && !$v.operator.rank.required" >Заполните поле</div>
                        </div>
                    </div>
                    <div class="col-10 text-right pl-0 pr-0">
                        <button class="btn btn-sm btn-primary" @click="save">Сохранить</button>
                        <button class="btn btn-sm" @click="closeOperator">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
import { required, minLength, alpha } from 'vuelidate/lib/validators'
export default {
    props:[],
    data(){
        return{
            ModalEmploye: $("#ModalEmploye"),
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
    validations:{
        operator: {
            fname:{required},
            name:{required},
            lname:{},
            rank:{required},
        }
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
            this.$v.$touch()
            if(!this.$v.$invalid){
                let url = "";
                switch (this.type) {
                    case "edit":
                        url = "/api/employe/update";
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
                        $("#ModalEmploye").modal("show")
                        this.get()
                    }
                }).catch(e=>{
                    let alert = $("#alert");
                    alert.removeClass("alert-success")
                    alert.addClass("alert-danger")
                    alert.text(e.message);
                    alert.show();
                    setTimeout(function(){alert.hide()},5000);
                })
            }
        },
        onRowSelected(items) {

        },
        addNewEmployee(){
            let mod =$("#ModalEmploye");
            mod.modal("show")
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
            $("#ModalEmploye").modal("show")
        },
        closeOperator(){
            let mod =$("#ModalEmploye");
            mod.modal("hide")

        },
        deleteOperator(index){
            this.type = 'delete'
            let res = confirm("Вы действительно хотите удалить данную запись?")
            if(res){
                let da = this.dataRes.data[i];
                axios.post("/api/employe/delete", da).then(d=>{
                    let alert = $("#alert");
                    if(d.data.status == 200){
                        if(alert.hasClass("alert-danger")){
                            alert.removeClass("alert-danger")
                        }
                        alert.addClass("alert-success")
                        alert.text(d.data.data);
                        alert.show();
                    }else{
                        alert.removeClass("alert-success")
                        alert.addClass("alert-danger")
                        alert.text(d.data.data);
                        alert.show();
                    }
                    setTimeout(function(){alert.hide()},5000);
                    this.getList();
                }).catch(e=>{
                    let alert = $("#alert");
                    alert.removeClass("alert-success")
                    alert.addClass("alert-danger")
                    alert.text(e.message);
                    alert.show();
                    setTimeout(function(){alert.hide()},5000);
                })
            }
        },
        reset(){
            this.operator.fname = "";
            this.operator.name = "";
            this.operator.lname = "";
            this.operator.rank = "";
        }
    },
}
</script>
