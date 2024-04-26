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
                    <li class="breadcrumb-item active">All Models</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Models
                            <router-link to="/models-create" class="btn btn-primary btn-sm float-end">Add Models</router-link>
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
                                <tr v-for="(models, index) in filterSearch" :keys="index">
                                    <th scope="row">{{ ++index }}</th>
                                    <td>{{ models.name }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name:'editModels', params:{id: models.id}}" class="btn btn-warning btn-sm m-1"><i class="bi bi-pencil"></i></router-link>
                                        <a @click="removeModels(models.id)" class="btn btn-danger btn-sm m-1" title="Remove"><i class="bi bi-trash-fill"></i></a>
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
            models: [],
            searchItem: ''
        }
    },
    computed:{
        filterSearch(){
            return this.models.filter(model => {
                return model.name.toLowerCase().match(this.searchItem);
            })
        }
    },
    created() {
        if (!User.loggedIn()) {
            this.$router.push('/login')
        }
    },
    components: {Header: Header, Sidebar: Sidebar, Footer: Footer},
    mounted() {
        this.allModels()
    },
    methods: {
        allModels() {
            axios.get('/api/models')
                .then(res => {
                    this.models = res.data;
                })
                .catch(
                    error => console.log(error.response)
                )
        },

        removeModels(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/models/' + id)
                    .then(() => {
                        this.models = this.models.filter(model => {
                            return model.id != id;
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'allModels'})
                    })
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                } else if(result.isDenied){
                    Swal.fire({
                        title: "Cancel",
                        text: "Changes are not saved.",
                        icon: "info"
                    });
                }
            });
        }
    }
}
</script>
