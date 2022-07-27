<template>
  <div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" @click.prevent="" class="h1"><b>顧客関係管理</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">サインインして開始</p>

      <form method="POST" @submit.prevent="login">
        <div class="input-group mb-3">
          <input type="email" class="form-control" v-model="email" placeholder="電子メールアドレス">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" v-model="password" placeholder="パスワード">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">ログイン</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</template>

<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        logoSrc:'',
        has_error: false
      }
    },
    methods: {
      login() {
          axios.post('auth/login',{email:this.email,password:this.password}).then(({data})=>{
            // this.setWithExpiry("token", data.access_token, this.myTTL) //3600 sec or 1 hour
            this.setWithExpiry("token", data.access_token, data.expires_in) //3600 sec or 1 hour
            localStorage.setItem("user", JSON.stringify(data.user))
            localStorage.setItem("Permissions", JSON.stringify(data.permissions))
            localStorage.setItem("log_first", 1)
            axios.defaults.headers.common['Authorization'] =`Bearer ${this.getWithExpiry("token")}` ;
            this.$router.push({ name: 'admin_home'})
            Fire.$emit('header_nav');
          })
          .catch(() => {
                this.alert_icon='error',
                this.alert_title='Ohh!!',
                this.alert_text='User name or password missmatch'
                this.sweet_advance_alert();
            });
      }
    },
    mounted() {
      //
    },
    created(){
        this.logoSrc = '../public/dashboard/logo/cropped-Jacos-main.png';
        Fire.$emit('header_nav');
    }
  }
</script>


