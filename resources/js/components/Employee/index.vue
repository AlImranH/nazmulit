<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employees</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Employee</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Employees
                            <router-link to="/employee-create" class="btn btn-primary btn-sm float-end">Add Employee</router-link>
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
                                        <th scope="col">Designation</th>
                                        <th scope="col">Joining Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(employee, index) in filterSearch" :keys="index">
                                        <th scope="row">{{ ++index }}</th>
                                        <td>{{ employee.full_name }}</td>
                                        <td>{{ employee.mobile }}</td>
                                        <td>{{ employee.designation }}</td>
                                        <td>{{ employee.joining_date }}</td>
                                        <td>
                                            <router-link :to="{name:'editEmployee', params:{id: employee.id}}" class="btn btn-warning btn-sm m-1"><i class="bi bi-pencil"></i></router-link>
                                            <a @click="removeEmployee(employee.id)" class="btn btn-danger btn-sm m-1"><i class="bi bi-trash-fill"></i></a>
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
            employees: [],
            searchItem:''
        }
    },
    computed:{
        filterSearch(){
            return this.employees.filter(employee => {
                return employee.mobile.match(this.searchItem);
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
        this.allEmployees()
    },
    methods: {
        allEmployees(){
            axios.get('/api/employees')
            .then(res => {
                this.employees = res.data;
            })
            .catch(
                error => console.log(error.response)
            )
        },

        removeEmployee(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    axios.delete('/api/employee/'+id)
                    .then(()=>{
                        this.employees = this.employees.filter(employee => {
                            return employee.id != id;
                        })
                    })
                    .catch(err => console.log(err))
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
