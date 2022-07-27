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
                            <div class="col-md-6">
                                <label for="search_j_code" class="col-form-label-sm">Janコードで検索</label>
                                <input type="text" class="form-control form-control-sm" id="search_j_code" v-model="formPaginate.search_j_code" placeholder="Janコードで検索">
                            </div>
                            <div class="col-md-6">
                                <label for="search_name" class="col-form-label-sm">小売名</label>
                                <input type="text" class="form-control form-control-sm" v-model="formPaginate.search_name" id="search_name" placeholder="名前で検索">
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
                    <label for="file_url" class="col-form-label-sm">Import Seller</label>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input form-control-sm" id="file_url" :class="{ 'is-invalid': formTwo.errors.has('file_url') }" name="file_url" @change="onFileChange">
                        <label class="custom-file-label col-form-label-sm" for="file_url"> <small>Import Seller</small> </label>
                        <has-error :form="formTwo" field="file_url"></has-error>
                    </div>
                </div>
           </div>
        </div>




       

       
        <div class="col-md-12 mt-2" >
            <div class="card">
                <div class="card-header bg-secondary">
                    <div class="row">
                        <div class="col-md-7">
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
                            <button type="button" @click="downloadSellerCsv" class="btn btn-warning btn-sm float-right btn-block"> <b-icon icon="cloud-download" class="far" font-scale="1.2"></b-icon>Export</button>
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-info btn-sm float-right btn-block" data-toggle="modal" data-target="#exampleModal"><b-icon icon="plus" class="far" font-scale="1.2"></b-icon> New Seller</button>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-sm mb-5 table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th class="pointer_class" @click="sorting('j_code')">Jan Code <span class="float-right" :class="iconSet('j_code')"></span></th>
                            <th class="pointer_class" @click="sorting('name')">Name <span class="float-right" :class="iconSet('name')"></span></th>
                            <th class="pointer_class" scope="col" @click="sorting('tel')">Tel <span class="float-right" :class="iconSet('fax')"></span></th> 
                            <th class="pointer_class" scope="col" @click="sorting('fax')">Fax <span class="float-right" :class="iconSet('fax')"></span></th> 
                            <th class="pointer_class" scope="col" @click="sorting('post_code')">P.C. <span class="float-right" :class="iconSet('post_code')"></span></th> 
                            <!-- <th scope="col">Address <span class="float-right" :class="iconSet('super_code')"></span></th>  -->

                            <th class="pointer_class" scope="col" @click="sorting('billing_tel')">B. Tel <span class="float-right" :class="iconSet('billing_tel')"></span></th> 
                            <th class="pointer_class" scope="col" @click="sorting('billing_fax')">B. Fax <span class="float-right" :class="iconSet('billing_fax')"></span></th> 
                            <th class="pointer_class" scope="col" @click="sorting('billing_post_code')">B. P.C. <span class="float-right" :class="iconSet('billing_post_code')"></span></th> 
                            <!-- <th scope="col">B. Address <span class="float-right" :class="iconSet('super_code')"></span></th>    -->
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(seller,index) in sellerList" :key="seller.seller_id">
                                <th scope="row">{{pageNo + index}}</th>
                                <td>{{seller.j_code}}</td>
                                <td>{{seller.name}} [{{seller.name_kana}}]</td>
                                <td>{{seller.tel}}</td>
                                <td>{{seller.fax}}</td>
                                <td>{{seller.post_code}}</td>
                                <!-- <td>{{seller.address}}</td> -->
                                <td>{{seller.billing_tel}}</td>
                                <td>{{seller.billing_fax}}</td>
                                <td>{{seller.billing_post_code}}</td>
                                <!-- <td>{{seller.billing_address}}</td> -->
                                <td>
                                    <router-link :to="{name: 'seller_edit', query: { id: seller.seller_id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
                                    <b-button @click.prevent="deleteData(seller.seller_id,index)" variant="danger" size="sm"><i class="fas fa-trash-alt"></i></b-button>
                                </td>
                            </tr>
                           </tbody>
                    </table>
                    <small id="emailHelp" class="form-text text-muted">{{ PaginateData.from }}〜{{PaginateData.to}} 件表示中／全：{{ PaginateData.total }}件</small>
                   
                </div>
            </div>
        </div>
        <b-modal ref="my-modal" hide-footer title="Confirmation">
            <div class="d-block text-center">
                <h3>Do you really want to delete?</h3>
            </div>
            <b-button class="mt-3 " variant="danger" @click="hideModal">Close</b-button>
            <b-button class="mt-3 float-right" variant="warning" @click="toggleModal(singleBuyer)">Confirm</b-button>
        </b-modal>

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
                            <div class="form-group col-6">
                                <label for="j_code">Jan Code</label>
                                <input type="text" class="form-control" name="j_code" :class="{ 'is-invalid': form.errors.has('j_code') }" id="j_code" v-model="form.j_code" placeholder="Jan Code">
                                 <has-error :form="form" field="j_code"></has-error>
                            </div>

                            <div class="form-group col-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" name="name" id="name" v-model="form.name" placeholder="Name">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="name_kana">Name Kana</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name_kana') }" name_kana="name_kana" v-model="form.name_kana" id="name_kana" placeholder="Name Kana">
                                <has-error :form="form" field="name_kana"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="post_code">Post Code</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('post_code') }" post_code="post_code" id="post_code" v-model="form.post_code" placeholder="Post Code">
                                <has-error :form="form" field="post_code"></has-error>
                            </div>
                            <div class="form-group col-12">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }" address="address" id="address" v-model="form.address" placeholder="Address">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="tel">Telephone</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('tel') }" tel="tel" id="tel" v-model="form.tel" placeholder="Telephone">
                                <has-error :form="form" field="tel"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('fax') }" fax="fax" id="fax" v-model="form.fax" placeholder="Fax">
                                <has-error :form="form" field="fax"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="billing_post_code">Billing Post Code</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('billing_post_code') }" name="billing_post_code" id="billing_post_code" v-model="form.billing_post_code" placeholder="Billing Post Code">
                                <has-error :form="form" field="billing_post_code"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="billing_address">Billing Address</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('billing_address') }" name="billing_address" id="billing_address" v-model="form.billing_address" placeholder="Billing Address">
                                <has-error :form="form" field="billing_address"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="billing_tel">Billing Telephone</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('billing_tel') }" name="billing_tel" id="billing_tel" v-model="form.billing_tel" placeholder="Billing Telephone">
                                <has-error :form="form" field="billing_tel"></has-error>
                            </div>
                            <div class="form-group col-6">
                                <label for="billing_fax">Billing Fax</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('billing_fax') }" name="billing_fax" id="billing_fax" v-model="form.billing_fax" placeholder="Billing Fax">
                                <has-error :form="form" field="billing_fax"></has-error>
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
import AdvancedLaravelVuePaginate from 'advanced-laravel-vue-paginate';
   export default {
       components: {
            AdvancedLaravelVuePaginate
        },
        data(){
            return {
                home_text:"Manage Seller",
                activeVal: 'home',
                sellerList : [],
                PaginateData: {},
                pageNo : '',
                loading: false,
                formPaginate : {
                    per_page:10,
                    page:1,
                    sort_by:'seller_id',
                    sort_type:"DESC",
                    search_j_code:"",
                    search_name:"",
                },
                form: new Form({
                    j_code:"",
                    name:"",
                    name_kana:"",
                    post_code:"",
                    address:"",
                    tel:"",
                    fax:"",
                    billing_post_code:"",
                    billing_address:"",
                    billing_tel:"",
                    billing_fax:"",
                }),
                formTwo: new Form({
                    type : '2',
                    file_url : ''
                }),
            }
        },
        methods:{
            downloadSellerCsv(){
                 axios.post('seller-csv-download',this.formPaginate)
                    .then(({data}) => {
                        const url = window.URL.createObjectURL(
                        new Blob([data], { type: "text/csv" })
                        );
                        const link = document.createElement("a");
                        link.href = url;
                        link.setAttribute("download", 'seller.csv');
                        document.body.appendChild(link);
                        link.click();
                    });
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
                         this.formTwo.post('buyer-seller-import')
                        .then(({ data }) => { 
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
            deleteData(id,index){
                this.$refs['my-modal'].show()
                this.singleBuyer = id
            },
             hideModal() {
                this.$refs['my-modal'].hide()
            },
            toggleModal(id) {
                 this.axios
                    .delete(`seller-manager/${id}`)
                    .then(response => {
                        if(response.data.success){
                            let i = this.sellerList.map(data => data.id).indexOf(id);
                            this.sellerList.splice(i, 1)
                            this.alert_title=response.data.message
                            this.alert_icon='success'
                            this.alert_text=''
                            this.sweet_normal_alert();
                            this.$refs['my-modal'].hide()
                        } 
                    });
            },
            getResults(page = 1) {
                this.formPaginate.page = page;
                axios.post('seller-manager',this.formPaginate)
                    .then(response => {
                        console.log(response);
                        this.sellerList = response.data.data;
                        this.PaginateData = response.data;
                        this.pageNo = response.data.from;
                    });
            },
            sorting(sorted_field){
                this.formPaginate.sort_by=sorted_field;
                this.formPaginate.sort_type=this.formPaginate.sort_type=="ASC"?"DESC":"ASC";
                this.getResults(this.formPaginate.page);

            },
            submitForm(){
                 this.form.post('seller-store')
                    .then(({ data }) => { 
                        if(data.success){
                            this.form.clear();
                            this.form.reset();
                            this.alert_title=data.message
                            this.alert_icon='success'
                            this.alert_text=''
                            this.sweet_normal_alert();
                            this.$router.push({name:'seller_manage'})
                            this.getResults();
                            jQuery('#exampleModal').modal('hide');
                        }
                    })
            }
        },
        mounted() {
            
          if(localStorage.getItem("log_first")==1){
            localStorage.removeItem("log_first");
                 let loaderrrsss = Vue.$loading.show();

            this.$router.go(0);
            // loaderrrsss
          }

           this.getResults();
        },
        beforeCreate: function() {
            Fire.$emit('header_nav');
        }
    }
</script>
<style scoped>
.pointer_class {
    cursor: pointer
}
.margin-top-5{
    margin-top: 5px;
}
</style>
