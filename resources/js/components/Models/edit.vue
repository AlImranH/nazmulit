<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Models</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item active">Update Models</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Update Models
                            <router-link to="/models" class="btn btn-primary btn-sm float-end">All Models</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <form class="row g-3" @submit.prevent="updateModels">
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label"> Category</label>
                                    <v-select v-model="form.category_id" label="name" :options="categories" :reduce="categories => categories.id" @option:selected="brandByCategory"></v-select>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label"> Brand</label>
                                    <v-select v-model="form.brand_id" label="name" :options="brands" :reduce="brands => brands.id" ></v-select>
                                </div>
                                <div class="col-md-4">
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
        this.modelsId = this.$route.params.id;
        this.loadCategories();
        this.loadBrand();
    },
    data(){
        return{
            form: {
                name:'',
                category_id:'',
                brand_id: '',
            },
            modelsId:'',
            categories:[],
            brands:[],
            errors:{}
        }
    },
    mounted(){
        this.getModel(this.modelsId);
    },
    methods:{
        getModel(modelsId){
            axios.get('/api/models/'+modelsId)
            .then(res => {
                this.form = res.data;
            })
            .catch(err => alert(err))
        },
        updateModels(){
            axios.put('/api/models/update/'+this.modelsId, this.form)
            .then(
                res => {
                    this.$router.push('/models')
                    Toast.fire({
                        icon: 'success',
                        title: 'Models has been added successfully.'
                    })

                }

            )
            .catch(
                error => {
                    this.errors = error.response.data.errors;
                }
            )
        },
        loadCategories(){
            axios.get('/api/category')
                .then(res => {
                    this.categories = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        loadBrand(){
            axios.get('/api/brand')
                .then(res => {
                    this.brands = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
    }

}
</script>
