<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Brand</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item active">Update Brand</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Update Brand
                            <router-link to="/brand" class="btn btn-primary btn-sm float-end">All Brand</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <form class="row g-3" @submit.prevent="updateBrand" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label"> Name</label>
                                    <input type="text" class="form-control" id="validationCustom01" v-model="form.name">
                                    <div class="valid-feedback" v-if="errors.name">
                                    {{ errors.name[0] }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Update</button>
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
            },
            brandId:'',
            errors:{}
        }
    },
    mounted(){
        // console.log(this.$route.params.id);
        this.getBrand(this.brandId);
    },
    created(){
        this.brandId = this.$route.params.id;
    },
    methods:{
        getBrand(brandId){
            axios.get('/api/brand/'+brandId)
            .then(res => {
                this.form = res.data;
            })
            .catch(err => alert(err))
        },
        updateBrand(){
            axios.put('/api/brand/update/'+this.brandId, this.form)
            .then(
                res => {
                    this.$router.push('/brand')
                    Toast.fire({
                        icon: 'success',
                        title: 'Brand has been added successfully.'
                    })

                }

            )
            .catch(
                error => {
                    this.errors = error.response.data.errors;
                }
            )
        }
    }

}
</script>
