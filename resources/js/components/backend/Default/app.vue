
<template>
<div>
    <div v-if="token">
        <navbar v-if="token" :app="this"></navbar>
        <login_navbar v-else :app="this"></login_navbar>
        <sidebar v-if="token" :app="this"></sidebar>

        <div class="content-wrapper">
            <!-- <contentHeader :app="this"></contentHeader> -->
            <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <router-view/>
                        </div>
                    </section>
                    <!-- Main content -->
        </div>

        <projectfooter :app="this"></projectfooter>
    </div>

    <div v-else>
        <body class="hold-transition login-page">
        <login_body :app="this"></login_body>
        </body>
    </div>
            
</div>
</template>

<script>
import navbar from './navbar'
import login_navbar from '../../backend/Login/login_nav'
import login_body from '../../backend/Login/login_body'
import sidebar from './side_bar'
import projectfooter from './project_footer'
// import contentHeader from './content_header'
export default {
name:'app',
components:{
navbar,
login_navbar,
login_body,
sidebar,
projectfooter,
// contentHeader
},
data(){
    return{
        user:null,
        loading:false,
        initiated:false,
        token: null,
    }
},
methods:{
    token_set(){
        this.token=this.getWithExpiry('token')
        if (this.token==null) {
            this.$router.push({name:'admin_login'}).catch(()=>{});
        }
}
},
created(){
   this.token_set()
    Fire.$on("header_nav", () => {
        this.token_set();
    });
}
}
</script>
<style>
.table-condensed{
  font-size: 12px;
}

</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
