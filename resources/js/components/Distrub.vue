<template>
<div class="">
    <div class="alert alert-success " id="alert" role="alert"></div>
    <nav>
        <div class="overflow-hidden sm:rounded-md">
            <div class="px-0 py-3 bg-white sm:p-6">
                <div class="grid grid-cols-2 gap-2">
                    <div class="col-span-6 sm:col-span-3 inline-block">
                        <button @click="addNewDistrub" class="px-6 py-2 bg-blue-500 inline-block   border-white hover:bg-blue-600 text-white"><i class="fa fa-plus-square"></i></button>
                        <b-form-select v-model="limit" size="sm" :options="limitList" class="px-6 py-2 min-w-10 w-20 m-0 inline-block border border-gray-700" @change="getList"></b-form-select>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ---------------- TABLE ------------------- -->
    <b-table :items="dataRes.data" :fields="fields" thead-tr-class="bg-blue-400 text-white"
                tbody-tr-class="bg-white border-bottom border-gray-600"
                details-td-class="py-2 px-3"
      @row-selected="onRowSelected" select-mode="single">
            <template #cell(index)="data">
                {{ data.index + 1 }}
            </template>
            <template #cell(dateTime)="data">
                {{ data.item.dates + " " + data.item.times }}
            </template>
            <template #cell(whom)="data">
                {{ data.item.whom == "employee" ? 'сотрудника' : 'Осужденного/Подследственного'}}
            </template>
            <template #cell(prision)="data">
                {{data.item.prision.name}}
            </template>
            <template #cell(operator)="data">
                {{ data.item.operator.fname + " " + data.item.operator.name.substring(0, 1)+"."}}
            </template>
            <template #cell(action)="data">

                <button type="button" @click="viewDistrub(data.index)" class="px-5 py-2 text-white bg-blue-500 hover:bg-blue-700"><i class="fa fa-eye"></i></button>
                <button type="button" @click="editDistrub(data.index)" class="px-5 py-2 text-white bg-green-500 hover:bg-green-700"><i class="fa fa-edit"></i></button>
                <button type="button" @click="deleteDistrub(data.index)" class="px-5 py-2 text-white bg-red-500 hover:bg-red-700"><i class="fa fa-times"></i></button>

            </template>
    </b-table>

    <!-- ----------------pagination------------------- -->
    <pagination align="center" :data="dataRes" @pagination-change-page="getList"></pagination>

    <!-- ---------------- Modal ------------------- -->
    <b-modal v-model="addModalOpen" modal-class="animate__animated animate__zoomIn" size="lg" content-class="shadow" hide-footer title="Новое нарушение" no-fade>
        <form @submit.prevent="save">
        <div class="form-group row">
            <label for="distrub-operator_id" class="col-md-3 col-form-label">Оператор</label>
            <div class="col-md-8">
                <b-form-select v-model.trim="$v.distr.operator.$model" id="distrub-operator_id" size="sm" class="mt-3">
                    <b-select-option  v-for="(i, e) in employe" :key="e" :value="i" v-text="(e+1) + '. ' +i.fname "></b-select-option>
                </b-form-select>
                <div class="error-invalid" v-if="$v.distr.operator.$error && !$v.distr.operator.required" >Выберите оператора обнружившего нарушение</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-date" class="col-md-3 col-form-label ">Дата и время</label>
            <div class="col-md-8">
                <input type="datetime-local" v-model.trim="$v.distr.datetime.$model"  class="form-control form-control-sm" name="" id="distrub-date">
                <div class="error-invalid" v-if="$v.distr.datetime.$error && !$v.distr.datetime.required" >Заполните поле</div>
            </div>
        </div>
        <div class="form-group row" >
            <label for="distrub-descript" class="col-md-3 col-form-label ">Описание</label>
            <div class="col-md-8">
                <b-form-textarea id="distrub-descript" v-model.trim="$v.distr.descript.$model" rows="4" size="sm" autocomplete="off"></b-form-textarea>
                <div class="error-invalid" v-if="$v.distr.descript.$error && !$v.distr.descript.required" >Заполните поле</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-whom" class="col-md-3 col-form-label ">В отношении</label>
            <div class="col-md-8">
                <b-form-select v-model.trim="$v.distr.whom.$model" id="distrub-whom" size="sm" class="mt-3">
                    <b-select-option value="employee">Сотрудника</b-select-option>
                    <b-select-option value="prison">Осужденного/Подследственного</b-select-option>
                </b-form-select>
                <div class="error-invalid" v-if="$v.distr.whom.$error && !$v.distr.whom.required" >Заполните поле</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-service" class="col-md-3 col-form-label ">Отписано</label>
            <div class="col-md-8">
                <b-form-select v-model.trim="$v.distr.service.$model" id="distrub-service" size="sm" class="mt-3">
                    <b-select-option  v-for="i in Directory.service" :key="i.id" :value="i" v-text="i.shortname"></b-select-option>
                </b-form-select>
                <div class="error-invalid" v-if="$v.distr.service.$error && !$v.distr.service.required" >Заполните поле</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-reg_num" class="col-md-3 col-form-label ">Номер и дата рег.</label>
            <div class="col-md-3">
                <input type="text" v-model.trim="$v.distr.reg_num.$model" id="distrub-reg_num" class="form-control form-control-sm" name="">
                <div class="error-invalid" v-if="$v.distr.reg_num.$error && !$v.distr.reg_num.required" >Заполните поле</div>
                <!-- <div class="error-invalid" v-if="$v.distr.reg_num.$error && !$v.distr.reg_num.alpha" >Только цивры</div> -->
            </div>
            <div class="col-md-4">
                <input type="date" v-model.trim="$v.distr.reg_date.$model" class="form-control form-control-sm" name="" id="">
                <div class="error-invalid" v-if="$v.distr.reg_date.$error && !$v.distr.reg_date.required" >Установите дату</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-dvr_type" class="col-md-3 col-form-label ">Тип и номер регистрат.</label>
            <div class="col-md-4">
                <b-form-select v-model.trim="$v.distr.dvr_type.$model" id="distrub-dvr_type" placeholder="Тип" size="sm" class="">
                    <b-select-option value="dvr">Видеонаблюдение</b-select-option>
                    <b-select-option value="bwc">Носимый видеорегистратор</b-select-option>
                </b-form-select>
                <div class="error-invalid" v-if="$v.distr.dvr_type.$error && !$v.distr.dvr_type.required" >Выберите тип регистратора</div>
            </div>
            <div class="col-md-3">
                <input type="text" v-model="distr.dvr_num" placeholder="номер" class="form-control form-control-sm" name="" id="dvr_num">
                <div class="error-invalid" v-if="$v.distr.dvr_num.$error && !$v.distr.dvr_num.required" >Заполните номер регистратора</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-distrub_type" class="col-md-3 col-form-label">Тип нарушения</label>
            <div class="col-md-8">
                <b-form-select v-model.trim="$v.distr.distrub_type.$model" id="distrub-distrub_type" size="sm" class="mt-3">
                    <b-select-option  v-for="(i, e) in Directory.distrub_type" :key="i.id" :value="i" v-text="(e+1) + '. ' +i.name"></b-select-option>
                </b-form-select>
                <div class="error-invalid" v-if="$v.distr.distrub_type.$error && !$v.distr.distrub_type.required" >Выберите тип нарушения</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-prision" class="col-md-3 col-form-label ">Учреждение</label>
            <div class="col-md-8">
                <select v-model.trim="$v.distr.prision.$model" size="sm" id="distrub-prision" class="distrub-prision form-control form-control-sm mt-3">
                    <option v-for="(i) in Directory.prision" :key="i.id" :value="i" v-text="i.name"></option>
                </select>
                <div class="error-invalid" v-if="$v.distr.prision.$error && !$v.distr.prision.required" >Выберите Учреждение где зафиксировано нарушение</div>
                <!-- <Select2 v-model="distr.prision_id"  :options="prisions"></Select2> -->
            </div>
        </div>
        <div class="form-group row">
            <label for="distrub-file" class="col-md-3 col-form-label ">Файлы</label>
            <div class="col-md-8">
                <b-card no-body header-bg-variant="primary" header-class="pt-1 pb-1 text-white">
                    <template #header>
                        <div class="col pl-0 pr-0" v-b-toggle.accordion-1>Файлы {{file.length}}</div>
                    </template>
                    <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                    <b-card-body class="p-2">
                        <b-row class="ml-1 mr-1">
                            <b-col v-for="(e, i) in file" :key="i" class="border text-center deleteFile p-0 mr-1" sm="1">
                                <span @click="DeleteFile(i)" class="deleteIcon "><i class="fa fa-times"></i></span>
                                <span style="font-size: 32px;"><i class="fa fa-file-image"></i></span>
                            </b-col>
                            <b-col class="p-0">
                                <!-- <b-form-file v-model="file" ref="file-input" class="selectFile hidden mb-2"></b-form-file> -->
                                <input type="file" name="" @change="fileChange" class="selectFile d-none" id="">
                                <span style="font-size: 32px; border: 1px dashed #000" @click="openFileMode" class="btn p-2"><i class="fa fa-plus-square"></i></span>
                            </b-col>
                        </b-row>
                    </b-card-body>
                    </b-collapse>
                </b-card>
            </div>
        </div>
        <div class="col-10 text-right pl-0 pr-0">
            <button class="btn btn-sm btn-primary" >Сохранить</button>
            <a href="#" class="btn btn-sm" @click="closeDistubModal">Отмена</a>
        </div>
        </form>
    </b-modal>
</div>
</template>

<script>
import { required, minLength, alpha } from 'vuelidate/lib/validators'

export default {
    props:[],
    data(){
        return{
            addModalOpen: false,
            type: 'create',
            distr: {
                datetime: '',
                descript: '',
                whom: '',
                service: '',
                reg_num: '',
                reg_date: '',
                dvr_type: '',
                dvr_num: '',
                distrub_type: '',
                prision: '',
                operator: '',
                file: []
            },
            limit: 10,
            limitList:[{value: 10,text: 10},{value: 25,text: 25},{value: 50,text: 50},],
            dataRes: {data:[]},
            Directory:{
                prision: []
            },
            files: [],
            file: [],
            employe: [],
            fields:[{key: "index",label: "№"},{key: "dateTime",label: "Дата и время"},{key: "descript",label: "Описание"},{key: "whom",label: "в отношении"},{key: "prision",label: "Учреждение"},{key: "operator",label: "Оператор"},{key: "action",label: "Действие"},]
        }
    },
    computed:{

    },
    mounted() {
        $("#alert").hide()
        this.getList()
        this.getDirectory();
        this.getEmploye()

    },
    validations:{
        distr: {
            descript:{required},
            service:{required},
            whom:{required},
            datetime:{required},
            operator:{required},
            dvr_type:{required},
            dvr_num:{required},
            reg_date:{required},
            prision:{required},
            distrub_type:{required},
            reg_num:{required},
        }
    },
    methods: {
        getList(page = 1){
            axios.post("/api/distrub/list", {"limit":this.limit}).then(d=>{
                this.dataRes = d.data.data

            }).catch(e=>{
                console.log(e)
            })
        },
        getDirectory(){
            axios.get("/api/prison/list").then(d=>{
                this.Directory.prision = d.data.prision;
                this.Directory.service = d.data.service;
                this.Directory.distrub_type = d.data.distrubType;

            }).catch(e=>{
                console.log(e)
            })
        },

        getEmploye(page=1){
            axios.get("/api/employe/all").then(d=>{
                this.employe = d.data
                console.log(d.data)
            }).catch(e=>{
                console.log(e)
            })
        },
        addNewDistrub(){
            this.type = 'create'
            this.addModalOpen = true;
        },
        save(){
            this.$v.$touch()
            if(!this.$v.$invalid){
                this.file.forEach(d=>{
                    this.distr.file.push(d.result)
                })
                let url = "/api/distrub/add";
                switch (this.type) {
                    case "update":
                        url = "/api/distrub/update";
                        break;
                    default:
                        url = "/api/distrub/add";
                        break;
                }
                axios.post(url, this.distr).then(d=>{
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
                    this.addModalOpen = false;
                }).catch(e=>{

                })
            }else{
                console.log("in-valid")
            }
        },
        editDistrub(i){
            this.type = 'update'
            this.distr = this.dataRes.data[i]
            this.distr.datetime = this.distr.dates +"T"+ this.distr.times
            this.addModalOpen = true;            
        },
        deleteDistrub(i){
            let res = confirm("Вы действительно хотите удалить данную запись?")
            if(res){
                let da = this.dataRes.data[i];
                axios.post("/api/distrub/delete", da).then(d=>{
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
        onRowSelected(){

        },
        viewDistrub(i){
            let id = this.dataRes.data[i].id
            window.location.href = "/api/distrub/detail/"+id
        },
        onContext(ctx) {
            // The date formatted in the locale, or the `label-no-date-selected` string
            this.formatted = ctx.selectedFormatted
            // The following will be an empty string until a valid date is entered
            this.selected = ctx.selectedYMD
        },
        openFileMode(e){
            let file = $(".selectFile");
            file.trigger('click')

            //file.change(this.fileChange(e))
        },
        fileChange(e){
            var files = e.target.files;
            if (files.length < 1) {
                return;
            }
            var file = files[0];
            var reader = new FileReader();
            let data = null;
            reader.readAsDataURL(file);
            this.file.push(reader)
        },
        DeleteFile(i){
            this.file.splice(i,1)            
        },
        closeDistubModal(){
            this.addModalOpen = false;
            this.reset();
        },
        reset(){
            this.distr.datetime = "";
            this.distr.descript = "";
            this.distr.whom = "";
            this.distr.service = "";
            this.distr.reg_num = "";
            this.distr.reg_date = "";
            this.distr.dvr_type = "";
            this.distr.dvr_num = "";
            this.distr.distrub_type = "";
            this.distr.prision = "";
            this.distr.operator = "";
            this.distr.file = [];
        }
    },

}
</script>
