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
                            <div class="col-md-4">
                                <label for="search_partner_code" class="col-form-label-sm">取引先コード</label>
                                <input type="text" class="form-control form-control-sm" v-model="formPaginate.search_partner_code" id="search_partner_code" placeholder="取引先コード検索">
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
                    <label for="file_url" class="col-form-label-sm">Import Connect Seller-Buyer</label>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input form-control-sm" id="file_url" :class="{ 'is-invalid': formTwo.errors.has('file_url') }" name="file_url" @change="onFileChange">
                        <label class="custom-file-label col-form-label-sm" for="file_url"> <small>Import Connect</small> </label>
                        <has-error :form="formTwo" field="file_url"></has-error>
                    </div>
                </div>
           </div>
        </div>

         <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                   
                    
                    <div class="col-md-8">
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
                        <div class="form-group">
                            <select @change="getResults" v-model="formPaginate.per_page" class="form-control form-control-sm selectPage float-right">
                                <option value="10">10行</option>
                                <option value="20">20行</option>
                                <option value="50">50行</option>
                                <option value="100">100行</option>
                            </select>
                        
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-sm float-right btn-block" data-toggle="modal" data-target="#exampleModal"><b-icon icon="plus" class="far" font-scale="1.2"></b-icon> Connect Seller-Buyer</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table  table-sm  mb-5  table-hover">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <!-- <th class="pointer_class" >Partner Code<span class="float-right" :class="iconSet('j_code')"></span></th>
                            <th class="pointer_class" > <span class="float-right" :class="iconSet('name')"></span></th> -->
                            <th scope="col" @click="sorting('partner_code')">Partner Code<span class="float-right" :class="iconSet('partner_code')"></span></th>
                            <th scope="col" @click="sorting('seller_name')">Seller<span class="float-right" :class="iconSet('seller_name')"></span></th>
                            <th scope="col" @click="sorting('buyer_name')">Buyer<span class="float-right" :class="iconSet('buyer_name')"></span></th>
                            <th scope="col" @click="sorting('service_start')">Service Start<span class="float-right" :class="iconSet('service_start')"></span></th> 
                            <th scope="col" @click="sorting('service_end')">Service End<span class="float-right" :class="iconSet('service_end')"></span></th>   
                            <!-- <th scope="col">Action</th>    -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(objData,index) in PaginateData.data" :key="objData.connect_id">
                                <th scope="row">{{pageNo + index}}</th>
                                <td>{{objData.partner_code}}</td>
                                <td>{{objData.seller_list.name}}</td>
                                <td>{{objData.buyer_list.name}}</td>
                                <td>{{objData.service_start}}</td>
                                <td>{{objData.service_end}}</td>
                                
                            <!-- <td>
                                     <router-link :to="{name: 'seller_edit', query: { id: seller.seller_id }}" class="btn btn-primary"><i class="fas fa-edit"></i></router-link>
                                    <b-button @click.prevent="deleteData(seller.seller_id,index)" variant="danger"><i class="fas fa-trash-alt"></i></b-button>
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
                                <label for="seller_id">Select Seller</label>
                                <multiselect v-model="form.seller_id" :class="{ 'is-invalid': form.errors.has('seller_id') }" :options="getSeller" label="name" track-by="seller_id" :searchable="true" placeholder="Select Seller" :custom-label="customSeller"></multiselect>
                                <has-error :form="form" field="seller_id"></has-error>
                            </div>

                                <div class="form-group col-12">
                                <label for="buyer_id">Select Buyer</label>
                                <multiselect v-model="form.buyer_id" :options="getBuyer" label="name" :class="{ 'is-invalid': form.errors.has('buyer_id') }" track-by="buyer_id" :searchable="true" placeholder="Select Buyer" :custom-label="customBuyer"></multiselect>
                                <has-error :form="form" field="buyer_id"></has-error>
                            </div>

                                <div class="form-group col-12">
                                <label for="partner_code">Partner Code</label>
                                <input type="text" class="form-control" id="partner_code" v-model="form.partner_code" placeholder="Partner Code" :class="{ 'is-invalid': form.errors.has('partner_code') }">
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
                home_text:"Connect Seller & Buyer",
                activeVal: 'home',
                loading: false,
                form: new Form({
                }),
                getSeller : [],
                getBuyer : [],
                getConnect : {},
                PaginateData: {},
                pageNo : '',
                formPaginate : {
                    per_page:10,
                    page:1,
                    sort_by:'connect_id',
                    sort_type:"DESC",
                   
                },
                formTwo: new Form({
                    
                    file_url : ''
                }),
            }
        },
        methods:{
            submitForm(){
                
                 this.form.post('connect-store')
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
                        }else{
                            this.alert_title=data.message
                            this.alert_icon='warning'
                            this.alert_text=''
                            this.sweet_normal_alert();
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
                         this.formTwo.post('connect-seller-buyer-import')
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
            customSeller({seller_id,name,name_kana,j_code}){
                return `${j_code} — [${name}]`
            },
            customBuyer({buyer_id,name,name_kana,super_code}){
                return `${super_code} — [${name}]`
            },
            getResults(page = 1) {
                this.formPaginate.page = page;
                this.axios.post('get-connect',this.formPaginate)
                .then(({data}) => {
                    
                    this.PaginateData = data;
                    this.pageNo = data.from;

                    //  console.log(data.data);
                });
            },
            sorting(sorted_field){
                this.formPaginate.sort_by=sorted_field;
                this.formPaginate.sort_type=this.formPaginate.sort_type=="ASC"?"DESC":"ASC";
                // console.log(this.formPaginate.sort_by,this.formPaginate.sort_type);
                this.getResults(this.formPaginate.page);

            },
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

            this.axios.post('get-seller')
            .then(response => {
                this.getSeller = response.data;
            });    
        }
    }
</script>
