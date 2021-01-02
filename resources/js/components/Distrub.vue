<template>
<div class="">
    <div class="alert alert-success hidden" id="alert" role="alert">
    
    </div>
    <button @click="addNewDistrub" class="btn btn-sm btn-outline-success mb-3 pr-5 pl-5"><i class="fa fa-plus-square"></i></button>
    <b-modal v-model="addModalOpen" modal-class="animate__animated animate__zoomIn" size="lg" content-class="shadow" hide-footer title="Новый оператор" no-fade>
        <div class="form-group row">
            <label for="fname" class="col-md-4 col-form-label text-md-right">Фамилия</label>
            <div class="col-md-6">
                <input id="fname" v-model="distr.date" type="text" class="form-control is-invalid" name="fname" required autofocus>
            </div>
            <div class="invalid-feedback">
                
            </div>
        </div>
        
        <div class="form-group row">
            <label for="rankSelect" class="col-md-4 col-form-label text-md-right">Звание</label>
            <div class="col-md-6">
                <b-form-select v-model="distr.prision_id" size="sm" class="mt-3">                    
                    <!-- <b-form-select-option v-for="i in rankList" :key="i.id" :value="i">{{i.name}}</b-form-select-option>                     -->
                </b-form-select>                
            </div>
        </div>
        <div class="col-10 text-right pl-0 pr-0">
            <button class="btn btn-sm btn-primary" @click="save">Сохранить</button>
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
                addModalOpen: true,
                distr: {
                    date: '',
                    time: '',
                    descript: '',
                    whom: '',
                    serviced: '',
                    reg_num: '',
                    reg_date: '',
                    dvr_type: '',
                    dvr_num: '',
                    distrub_type: '',
                    prision_id: '',
                    operator_id: '',
                    user_id: '',
                }
            }
        },
        computed:{

        },
        mounted() {
        $("#alert").hide()
        },
        methods: {
            addNewDistrub(){

            },
            save(){

            }
        },
    }
</script>
