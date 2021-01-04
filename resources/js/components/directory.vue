<template>
  <div>
    <b-card no-body>
      <b-tabs v-model="tabIndex" card>
        <b-tab title="Службы" :title-link-class="linkClass(0)">
            <!-- ---------------- TABLE ------------------- -->
            <b-table :items="dataRes.data" :fields="fields" >
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <!-- <template #cell(dateTime)="data">
                        {{ data.item.dates + " " + data.item.times }}
                    </template> -->
                    
                    <template #cell(action)="data">
                        <button type="button" @click="view(data.index)" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i></button>
                        <button type="button" @click="edit(data.index)" class="btn btn-sm btn-outline-primary"><i class="fa fa-user-edit"></i></button>
                        <button type="button" @click="delet(data.index)" class="btn btn-sm  btn-outline-danger"><i class="fa fa-user-times"></i></button>
                    </template>
            </b-table>
        </b-tab>
        <b-tab title="Типы нарушений" :title-link-class="linkClass(1)">
            
        </b-tab>
        <!-- <b-tab title="Tab 3" :title-link-class="linkClass(2)">Tab contents 3</b-tab> -->
      </b-tabs>
    </b-card>
  </div>
</template>

<script>
    export default {
        props:[],
        data(){
            return{
                tabIndex: 0,
                fields:[{key: "index",label: "№"},{key: "fullname",label: "Дата и время"},{key: "shortname",label: "Описание"},{key: "action",label: "Действие"},]
            }
        },
        computed:{

        },
        mounted() {
        
        },
        methods: {
            linkClass(idx) {
                if (this.tabIndex === idx) {
                return ['bg-primary', 'text-light']
                } else {
                return ['bg-light', 'text-info']
                }
            },
            update(){

            },
            view(){
            },
            edit(){
            },
            delet(){
            },
        },
    }
</script>
