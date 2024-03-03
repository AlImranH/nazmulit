<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Supplier</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Supplier</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Supplier
                            <router-link to="/supplier-create" class="btn btn-primary btn-sm float-end">Add Supplier</router-link>
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
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Web</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(supplier, index) in filterSearch" :keys="index">
                                        <th scope="row">{{ ++index }}</th>
                                        <td>{{ supplier.name }}</td>
                                        <td>{{ supplier.mobile }}</td>
                                        <td>{{ supplier.email }}</td>
                                        <td><a :href="supplier.web" target="_blank">{{ supplier.web }}</a></td>
                                        <td>
                                            <router-link :to="{name:'editSupplier', params:{id: supplier.id}}" class="btn btn-warning btn-sm m-1"><i class="bi bi-pencil"></i></router-link>
                                            <a @click="removeSupplier(supplier.id)" class="btn btn-danger btn-sm m-1" title="Remove"><i class="bi bi-trash-fill"></i></a>
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
            suppliers: [],
            searchItem: ''
        }
    },
    computed:{
        filterSearch(){
            return this.suppliers.filter(supplier => {
                return supplier.mobile.match(this.searchItem);
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
        this.allSupplier()
    },
    methods: {
        allSupplier(){
            axios.get('/api/supplier')
            .then(res => {
                this.suppliers = res.data;
            })
            .catch(
                error => console.log(error.response)
            )
        },

        removeSupplier(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    axios.delete('/api/supplier/'+id)
                    .then(()=>{
                        this.suppliers = this.suppliers.filter(supplier => {
                            return supplier.id != id;
                        })
                    })
                    .catch(() => {
                        this.$router.push({name:'allSupplier'})
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
