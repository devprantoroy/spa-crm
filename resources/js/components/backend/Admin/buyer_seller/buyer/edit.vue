<template>
    <div class="row">
        <div class="col-md-12">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">{{home_text}}</h3>
                </div>
            </div>
        </div>
        </div>

       
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                    {{home_text}} 
                </div>
                <div class="card-body">
                   <form @submit.prevent="submitForm" @keydown="form.onKeydown($event)">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="super_code">Super Code</label>
                                <input type="text" class="form-control" name="super_code" :class="{ 'is-invalid': form.errors.has('super_code') }" id="super_code" v-model="form.super_code" placeholder="Super Code">
                                 <has-error :form="form" field="super_code"></has-error>
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
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-sm float-right"> <b-icon icon="file-earmark" class="far" font-scale="1.2"></b-icon> Update</button>
                            </div>
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
                home_text:"Edit Buyer",
                activeVal: 'home',
                form: new Form({
                    super_code:"",
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
                })
            }
        },
        methods:{
             submitForm(){
                 this.form.patch(`buyer-update/${this.$route.query.id}`)
                    .then(({ data }) => { 
                        
                        if(data.success){
                            this.form.fill(data.data) 
                            this.alert_title=data.message
                            this.alert_icon='success'
                            this.alert_text=''
                            this.sweet_normal_alert();
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
        },
        created : function() {
            this.axios
                .get(`buyer-show/${this.$route.query.id}`)
                  .then(response => {
                      this.form.fill(response.data) 
                });
        },
         beforeCreate: function() {
            Fire.$emit('header_nav');
        }
    }
</script>
