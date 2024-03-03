<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item active">Update Category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Update Category
                            <router-link to="/category" class="btn btn-primary btn-sm float-end">All Category</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <form class="row g-3" @submit.prevent="updateCategory" enctype="multipart/form-data">
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
            categoryId:'',
            errors:{}
        }
    },
    mounted(){
        // console.log(this.$route.params.id);
        this.getCategory(this.categoryId);
    },
    created(){
        this.categoryId = this.$route.params.id;
    },
    methods:{
        getCategory(categoryId){
            axios.get('/api/category/'+categoryId)
            .then(res => {
                this.form = res.data;
            })
            .catch(err => alert(err))
        },
        updateCategory(){
            axios.put('/api/category/update/'+this.categoryId, this.form)
            .then(
                res => {
                    this.$router.push('/category')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category has been added successfully.'
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
