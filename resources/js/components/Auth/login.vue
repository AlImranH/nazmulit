<template>
    <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="@/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate @submit.prevent="login">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required v-model="form.email">
                        <div class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required v-model="form.password">
                      <div class="invalid-feedback" v-if="errors.password">{{ errors.password[0] }}</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account?
                        <router-link to="/register">Create an account</router-link>
                    </p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://errorpickers.com/" class="fw-bold"><span class="text-danger">Error</span>Pickers</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
</template>

<script>
export default{
    created(){
        if(User.loggedIn()){
            this.$router.push('/')
        }
    },
    data () {
        return{
            form:{
                email:'',
                password:''
            },
            errors: {}
        }
    },
    methods:{
        login (){
            axios.post('/api/auth/login', this.form)
            .then(
                res => {
                    User.responseAfterLogin(res)
                    this.$router.push('/')
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                }

                )
                .catch(
                    err => {
                        console.log(err);
                        // this.errors = err.response.data.errors

                        Toast.fire({
                            icon: 'warning',
                            title: 'Invalid username or passwords'
                        })
                    }

                )
        }
    }
}
</script>

