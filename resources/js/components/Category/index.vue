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
                    <li class="breadcrumb-item active">All Category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Category
                            <router-link to="/category-create" class="btn btn-primary btn-sm float-end">Add Category</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <label for="search">Search</label>
                            <input class="form-control mb-2" id="search" v-model="searchItem">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(category, index) in filterSearch" :keys="index">
                                        <th scope="row">{{ ++index }}</th>
                                        <td>{{ category.name }}</td>
                                        <td class="text-center">
                                            <router-link :to="{name:'editCategory', params:{id: category.id}}" class="btn btn-warning btn-sm m-1"><i class="bi bi-pencil"></i></router-link>
                                            <a @click="removeCategory(category.id)" class="btn btn-danger btn-sm m-1" title="Remove"><i class="bi bi-trash-fill"></i></a>
                                            <!-- <router-link class="btn btn-warning">Edit</router-link> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    data(){
        return{
            categories: [],
            searchItem: ''
        }
    },
    computed:{
        filterSearch(){
            return this.categories.filter(category => {
                return category.name.toLowerCase().match(this.searchItem);
            })
        }
    },
    created(){
        if(!User.loggedIn()){
            this.$router.push('/login')
        }
    },
    components: {Header:Header, Sidebar: Sidebar, Footer: Footer},
    mounted() {
        this.allCategory()
    },
    methods: {
        allCategory(){
            axios.get('/api/category')
            .then(res => {
                this.categories = res.data;
            })
            .catch(
                error => console.log(error.response)
            )
        },

        removeCategory(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    axios.delete('/api/category/'+id)
                    .then(()=>{
                        this.categories = this.categories.filter(category => {
                            return category.id != id;
                        })
                    })
                    .catch(() => {
                        this.$router.push({name:'allCategory'})
                    })
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                }
                });
        }
    }
}
</script>
