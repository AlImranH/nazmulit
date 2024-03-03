<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employee</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item active">Update Employee</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Update Employee
                            <router-link to="/employees" class="btn btn-primary btn-sm float-end">All Employee</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <form class="row g-3" @submit.prevent="updateEmployee" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="validationCustom01" v-model="form.full_name">
                                    <div class="valid-feedback" v-if="errors.full_name">
                                    {{ errors.full_name[0] }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">NID</label>
                                    <input type="text" class="form-control" id="validationCustom02" v-model="form.nid" required>
                                    <div class="valid-feedback" v-if="errors.nid">
                                        {{ errors.nid[0] }}
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
                                <div class="col-md-4">
                                    <label for="validationCustom05" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="validationCustom05" v-model="form.designation" required>
                                    <div class="valid-feedback" v-if="errors.designation">
                                    {{ errors.designation[0] }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom06" class="form-label">Salary</label>
                                    <input type="number" class="form-control" id="validationCustom06" v-model="form.salary" required>
                                    <div class="valid-feedback" v-if="errors.salary">
                                    {{ errors.salary[0] }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom07" class="form-label">Joining Date</label>
                                    <input type="date" class="form-control" id="validationCustom07" v-model="form.joining_date" required>
                                    <div class="valid-feedback" v-if="errors.joining_date">
                                    {{ errors.joiningDate[0] }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom08" class="form-label">Gender</label>
                                    <select class="form-select" id="validationCustom08" v-model="form.gender">
                                        <option selected>Select One</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                      </select>
                                    <div class="valid-feedback" v-if="errors.gender">
                                    {{ errors.gender[0] }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationTextarea" class="form-label">Address</label>
                                    <textarea class="form-control" id="validationTextarea" placeholder="Address" v-model="form.address" required></textarea>
                                    <div class="invalid-feedback" v-if="errors.address">
                                    {{ errors.address[0] }}
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Image</label>
                                    <input type="file" class="form-control" aria-label="file example" @change="onFileSelected" accept="image/*"  required>
                                    <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>
                                </div>
                                <div class="col-md-6">
                                    <img :src="preview_image" alt="" style="height: 200px; width: 200px">
                                </div> -->
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
                full_name:'',
                nid:'',
                mobile:'',
                email:'',
                designation:'',
                salary:'',
                joining_date:'',
                gender:'',
                address:'',
                image:''
            },
            employeeId:'',
            preview_image:'',
            errors:{}
        }
    },
    mounted(){
        // console.log(this.$route.params.id);
        this.getEmpolyee(this.employeeId);
    },
    created(){
        this.employeeId = this.$route.params.id;
    },
    methods:{
        getEmpolyee(employeeId){
            axios.get('/api/employee/'+employeeId)
            .then(res => {
                this.form = res.data;
            })
            .catch(err => alert(err))
        },
        updateEmployee(){
            axios.put('/api/employee/update/'+this.employeeId, this.form)
            .then(
                res => {
                    this.$router.push('/employees')
                    Toast.fire({
                        icon: 'success',
                        title: 'Employee has been added successfully.'
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
