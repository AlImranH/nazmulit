<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Supplier</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item active">Add New Supplier</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Add New Supplier
                            <router-link to="/supplier" class="btn btn-primary btn-sm float-end">All Supplier</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <form class="row g-3" @submit.prevent="storeSupplier" enctype="multipart/form-data">
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label"> Name</label>
                                    <input type="text" class="form-control" id="validationCustom01" v-model="form.name">
                                    <div class="valid-feedback" v-if="errors.name">
                                    {{ errors.name[0] }}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom03" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="validationCustom03" v-model="form.mobile" required>
                                    <div class="valid-feedback" v-if="errors.mobile">
                                        {{ errors.mobile[0] }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom04" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="validationCustom04" v-model="form.email" required>
                                    <div class="valid-feedback" v-if="errors.email">
                                    {{ errors.email[0] }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom05" class="form-label">Web</label>
                                    <input type="text" class="form-control" id="validationCustom05" v-model="form.web" required>
                                    <div class="valid-feedback" v-if="errors.web">
                                    {{ errors.web[0] }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationTextarea" class="form-label">Address</label>
                                    <textarea class="form-control" id="validationTextarea" placeholder="Address" v-model="form.address" required></textarea>
                                    <div class="invalid-feedback" v-if="errors.address">
                                    {{ errors.address[0] }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End main section -->
    <Footer></Footer>

</template>

<script>
 import Header from '../Header.vue'
 import Sidebar from '../Sidebar.vue'
 import Footer from '../Footer.vue'

export default{
    components: {Header:Header, Sidebar: Sidebar, Footer: Footer},
    created(){
        if(!User.loggedIn()){
            this.$router.push('/login')
        }
    },
    data(){
        return{
            form: {
                name:'',
                mobile:'',
                email:'',
                address:'',
                web:''
            },
            errors:{}
        }
    },
    methods:{
        storeSupplier(){
            axios.post('api/supplier/store', this.form)
            .then(
                res => {
                    this.$router.push('/supplier')
                    Toast.fire({
                        icon: 'success',
                        title: 'Supplier has been added successfully.'
                    })
                    console.log(res.data);
                }

            )
            .catch(
                error => {
                    this.errors = error.response.data.errors;
                    // console.log(this.errors.full_name[0]);
                }
            )
        }
    }

}
</script>
