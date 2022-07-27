<template>
    <div class="row">
        <div class="col-md-12">
            <div class="main-content-container container-fluid px-4">
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <h3 class="page-title">{{home_text}}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8" >
            <div class="card">
                 <form  @submit.prevent="getResults" >
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="search_buyer_name" class="col-form-label-sm">Buyer 小売名</label>
                                <input type="text" class="form-control form-control-sm" id="search_buyer_name" v-model="formPaginate.search_buyer_name" placeholder="Buyer 小売名検索">
                            </div>
                            <div class="col-md-4">
                                <label for="search_seller_name" class="col-form-label-sm">Seller 小売名</label>
                                <input type="text" class="form-control form-control-sm" v-model="formPaginate.search_seller_name" id="search_seller_name" placeholder="Seller 小売名検索">
                            </div>
                            <!-- <div class="col-md-3">
                                <label for="search_partner_code" class="col-form-label-sm">取引先コード</label>
                                <input type="text" class="form-control form-control-sm" v-model="formPaginate.search_partner_code" id="search_partner_code" placeholder="取引先コード検索">
                            </div> -->
                             <div class="col-md-4">
                                <label for="search_data_count" class="col-form-label-sm">データ数</label>
                                <input type="text" class="form-control form-control-sm" v-model="formPaginate.search_data_count" id="search_data_count" placeholder="データ数ド検索">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <!-- <button type="button" class=" btn btn-warning float-right text-center btn-sm "><i class="fa fa-redo fa-xs"></i> Reset</button> -->
                        <button type="submit" class=" btn btn-primary float-right btn-sm ">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4" >
            <div class="card">
                <div class="card-body">
                     <div class="loader" v-if="loading">
                        <img style="max-width:120px;" src="https://c.tenor.com/I6kN-6X7nhAAAAAi/loading-buffering.gif" alt="">
                    </div>
                    <label for="file_url" class="col-form-label-sm">Data Count</label>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input form-control-sm" id="file_url" :class="{ 'is-invalid': formTwo.errors.has('file_url') }" name="file_url" @change="onFileChange">
                        <label class="custom-file-label col-form-label-sm" for="file_url"> <small>Import Data Count</small> </label>
                        <has-error :form="formTwo" field="file_url"></has-error>
                    </div>
                </div>
           </div>
        </div>



        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                    <div class="row">
                         <div class="col-md-9">
                            <span class="pagi float-left">
                                <advanced-laravel-vue-paginate
                                :data="PaginateData"
                                :onEachSide="2"
                                previousText="<"
                                nextText=">"
                                alignment="left"
                                useStyle="bootstrap"
                                listClass="pagination pagination-sm"
                                @paginateTo="getResults"
                                />
                            </span>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group ">
                                <select @change="getResults" v-model="formPaginate.per_page" class="form-control form-control-sm selectPage float-right">
                                    <option value="10">10行</option>
                                    <option value="20">20行</option>
                                    <option value="50">50行</option>
                                    <option value="100">100行</option>
                                </select>
                            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary float-right btn-sm btn-block" data-toggle="modal" data-target="#exampleModal"><b-icon icon="plus" class="far" font-scale="1.2"></b-icon> Add New</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table  table-sm  mb-5  table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="pointer_class">No</th>
                                <th class="pointer_class" @click="sorting('buyer_name')">Buyer Name <span class="float-right" :class="iconSet('buyer_name')"></span> </th>
                                <th class="pointer_class" @click="sorting('super_code')">Super Code <span class="float-right" :class="iconSet('super_code')"></span> </th>
                                <th class="pointer_class" @click="sorting('seller_name')" >Seller Name <span class="float-right" :class="iconSet('seller_name')"></span> </th> 
                                <th class="pointer_class" @click="sorting('j_code')">Jan Code <span class="float-right" :class="iconSet('j_code')"></span> </th> 
                                <!-- <th class="pointer_class" @click="sorting('partner_code')">Partner Code<span class="float-right" :class="iconSet('partner_code')"></span> </th>  -->
                                <th class="pointer_class" @click="sorting('start_date')">Start Date<span class="float-right" :class="iconSet('start_date')"></span> </th> 
                                <th class="pointer_class" @click="sorting('end_date')">End Date<span class="float-right" :class="iconSet('end_date')"></span> </th> 
                                <th class="pointer_class" @click="sorting('count')">Data Count <span class="float-right" :class="iconSet('count')"></span> </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(item,index) in PaginateData.data" :key="item.data_count_id">
                                <th scope="row">{{pageNo + index}}</th>
                                <td>{{item.buyer_list.name}}</td>
                                <td>{{item.buyer_list.super_code}}</td>
                                <td>{{item.seller_list.name}}</td>
                                <td>{{item.seller_list.j_code}}</td>
                                <!-- <td>{{item.partner_code}}</td> -->
                                <td>{{item.start_date}}</td>
                                <td>{{item.end_date}}</td>
                                <td>{{item.count}}</td>
                                <!-- <td>
                                    <router-link :to="{name: 'buyer_edit', query: { id: buyer.buyer_id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
                                     <b-button size="sm" @click.prevent="deleteData(buyer.buyer_id,index)" variant="danger"><i class="fas fa-trash-alt"></i></b-button>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{home_text}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="submitForm" @keydown="form.onKeydown($event)">
                    <div class="modal-body">
                    
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="buyer_id">Select Buyer</label>
                                <multiselect v-model="form.buyer_id" :options="getBuyer" @input="onBuyerChange" label="name" :class="{ 'is-invalid': form.errors.has('buyer_id') }" track-by="buyer_id" :searchable="true" placeholder="Select Buyer" :custom-label="customBuyer"></multiselect>
                                <has-error :form="form" field="buyer_id"></has-error>
                            </div>

                            <div class="form-group col-12">
                                <label for="seller_id">Select Seller</label>
                                <multiselect v-model="form.seller_id" @input="onSellerChange" :class="{ 'is-invalid': form.errors.has('seller_id') }" :options="getSeller" label="seller_list.name" track-by="seller_list" :searchable="true" placeholder="Select Seller" :custom-label="customSeller"></multiselect>
                                <has-error :form="form" field="seller_id"></has-error>
                            </div>

                            <div class="form-group col-12">
                                <label for="partner_code">Partner Code</label>
                                <input type="text" class="form-control" disabled id="partner_code" v-model="form.partner_code" placeholder="Partner Code" :class="{ 'is-invalid': form.errors.has('partner_code') }">
                                <has-error :form="form" field="partner_code"></has-error>
                            </div>

                            <div class="form-group col-12">
                                <label for="service_start">Start Date</label>
                                <b-form-datepicker autocomplete="off" id="service_start" :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }" v-model="form.service_start"  @context="onContext" class="form-control" :class="{ 'is-invalid': form.errors.has('service_start') }"></b-form-datepicker>
                                <has-error :form="form" field="service_start"></has-error>
                            </div>

                            <div class="form-group col-12">
                                <label for="service_end">End Date</label>
                                <b-form-datepicker autocomplete="off" id="service_end" :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }" v-model="form.service_end"  @context="onContext" class="form-control" :class="{ 'is-invalid': form.errors.has('service_end') }"></b-form-datepicker>
                                <has-error :form="form" field="service_end"></has-error>
                            </div>

                             <div class="form-group col-12">
                                <label for="count">Count</label>
                                <input type="text" class="form-control" id="count" v-model="form.count" placeholder="Count" :class="{ 'is-invalid': form.errors.has('count') }">
                                <has-error :form="form" field="count"></has-error>
                            </div>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <b-icon icon="file-earmark" class="far" font-scale="1.2"></b-icon> Save</button>
                    </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
    
</template>
<script>
    export default {
        
        data(){
            return {
                home_text:"Data Count List",
                activeVal: 'home',
                form: new Form({
                    partner_code : '',
                    seller_id : ''
                }),
                getSeller : [],
                getBuyer : [],
                PaginateData: {},
                pageNo : '',
                formPaginate : {
                    per_page:10,
                    page:1,
                    sort_by:'data_count_id',
                    sort_type:"DESC",
                },
                loading: false,
                formTwo: new Form({
                    file_url : ''
                }),
            }
        },
        methods:{
            submitForm(){
                 this.form.post('data-count-store')
                    .then(({ data }) => { 
                        // console.log(data);
                        // return false;
                        if(data.success){
                            this.form.clear();
                            this.form.reset();
                            this.alert_title=data.message
                            this.alert_icon='success'
                            this.alert_text=''
                            this.sweet_normal_alert();
                            this.getResults();
                            jQuery("#exampleModal").modal('hide');
                        }
                    })
            },
            
            onFileChange(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if(file.size < 2111775){
                    if (file.type =="text/csv") {
                        reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                     this.loading = true;
                         this.formTwo.file_url = reader.result;
                         this.formTwo.post('data-count-import')
                        .then(({ data }) => { 
                        //      console.log(data);
                        // return false;
                            if(data.success){
                                this.formTwo.clear();
                                this.formTwo.reset();
                                this.alert_title=data.message
                                this.alert_icon='success'
                                this.alert_text=''
                                this.sweet_normal_alert();
                                 this.getResults();
                            }else{
                                this.formTwo.clear();
                                this.formTwo.reset();
                                this.alert_icon='warning'
                                this.alert_text=''
                                this.alert_title=data.message
                                this.sweet_normal_alert();
                            }
                           
                        }).catch((error) => {
                            console.log(error);
                        }).finally(() => {
                            this.loading =  false
                        })
                    // this.user_image = reader.result;
                    }
                    reader.readAsDataURL(file);
                    }else{
                        this.alert_text='File must me CSV file.'
                        this.alert_title="Warning!",
                        this.alert_icon="warning"
                        this.sweet_normal_alert();
                $('#image').val('');
                    }
                }else{
                    this.alert_text='File size can not be bigger than 2 MB'
                    this.alert_title="Warning!",
                    this.alert_icon="warning"
                    this.sweet_normal_alert();
                $('#image').val('');
                }
            },
            onContext(ctx) {
               
                // The following will be an empty string until a valid date is entered
                this.selected = ctx.selectedYMD
            },
            customSeller({seller_list}){
                return `${seller_list.j_code} — [${seller_list.name}]`
            },
            customBuyer({buyer_id,name,name_kana,super_code}){
                return `${super_code} — [${name}]`
            },
            getResults(page = 1) {
                this.formPaginate.page = page;
                this.axios.post('get-data-count',this.formPaginate)
                .then(({data}) => {
                    this.PaginateData = data;
                    this.pageNo = data.from;
                    console.log(data.data);
                });
            },
             sorting(sorted_field){
                this.formPaginate.sort_by=sorted_field;
                this.formPaginate.sort_type=this.formPaginate.sort_type=="ASC"?"DESC":"ASC";
                // console.log(this.formPaginate.sort_by,this.formPaginate.sort_type);
                this.getResults(this.formPaginate.page);

            },
            onBuyerChange(){
                this.getSeller = [];
                this.form.partner_code = '';
                this.form.seller_id = '';
                if(this.form.buyer_id.connect_table != '' && this.form.buyer_id.connect_table.length > 0){
                    this.getSeller = this.form.buyer_id.connect_table;
                }
            },
            onSellerChange(){
                this.form.partner_code = this.form.seller_id.partner_code;
            }
        },
         mounted() {
            
          if(localStorage.getItem("log_first")==1){
            localStorage.removeItem("log_first");
                 let loaderrrsss = Vue.$loading.show();
            this.$router.go(0);
          }

            this.getResults();
          
        },
        beforeCreate: function() {
            Fire.$emit('header_nav');
        },
        created : function() {
            this.axios.post('get-buyer')
            .then(response => {
                this.getBuyer = response.data;
            });   
        }
    }
</script>
