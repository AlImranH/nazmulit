<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item active">Add New Purchase</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-12">
                    <form class="">
                        <div class="card">
                            <div class="card-header">
                                Invoice
                                <router-link to="/purchases" class="btn btn-primary btn-sm float-end">All Purchase</router-link>
                            </div>
                            <div class="card-body mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="validationINV" class="form-label">INV No.</label>
                                        <input type="text" class="form-control" id="validationINV" v-model="form.invoice.invoice_no" required>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="validationCustom03" class="form-label">Supplier</label>
                                        <i class="bi bi-patch-plus btn text-primary" type="button" data-bs-toggle="modal" data-bs-target="#supplierModal"></i>
                                        <v-select v-model="form.invoice.supplier_id" label="name" :options="suppliers" :reduce="suppliers => suppliers.id" required></v-select>
                                        <div class="valid-feedback" v-if="errors.mobile">
                                            {{ errors.mobile[0] }}
                                        </div>
                                    </div>

                                    <!-- Supplier Modal-->
                                    <div class="modal fade modal-lg" id="supplierModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Supplier</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" @submit.prevent="storeSupplier">
                                                        <div class="col-md-4">
                                                            <label for="validationCustom01" class="form-label"> Name</label>
                                                            <input type="text" class="form-control" id="validationCustom01" v-model="supplier.name">
                                                            <div class="valid-feedback" v-if="errors.name">
                                                                {{ errors.name[0] }}
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="validationCustom03" class="form-label">Mobile</label>
                                                            <input type="text" class="form-control" id="validationCustom03" v-model="supplier.mobile" required>
                                                            <div class="valid-feedback" v-if="errors.mobile">
                                                                {{ errors.mobile[0] }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="validationCustom04" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="validationCustom04" v-model="supplier.email" required>
                                                            <div class="valid-feedback" v-if="errors.email">
                                                                {{ errors.email[0] }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="validationCustom05" class="form-label">Web</label>
                                                            <input type="text" class="form-control" id="validationCustom05" v-model="supplier.web">
                                                            <div class="valid-feedback" v-if="errors.web">
                                                                {{ errors.web[0] }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="validationTextarea" class="form-label">Address</label>
                                                            <textarea class="form-control" id="validationTextarea" placeholder="Address" v-model="supplier.address" required></textarea>
                                                            <div class="invalid-feedback" v-if="errors.address">
                                                                {{ errors.address[0] }}
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Supplier Modal-->

                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="validationCustom04" v-model="form.invoice.date" required>
                                        <div class="valid-feedback" v-if="errors.email">
                                            {{ errors.email[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                Product
                                <a @click="storeTempPurchase" class="btn btn-success btn-sm float-end"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <div class="card-body mt-3">
                                <div class="row my-1">
                                    <div class="col-md-3">
                                        <label for="validationCategory" class="form-label">Category</label>
                                        <i class="bi bi-patch-plus btn text-primary" type="button" data-bs-toggle="modal" data-bs-target="#CategoryModal"></i>

                                        <v-select v-model="form.product.category_id" label="name" :options="categories" :reduce="categories => categories.id" @option:selected="brandByCategory"></v-select>

                                    </div>

                                    <!-- CATEGORY MODAL-->
                                    <div class="modal fade" id="CategoryModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" @submit.prevent="storeCategory" enctype="multipart/form-data">
                                                        <div class="col-md-12">
                                                            <label for="validationCustom01" class="form-label"> Name</label>
                                                            <input type="text" class="form-control" id="validationCustom01" v-model="category.name">
                                                            <div class="valid-feedback" v-if="errors.name">
                                                                {{ errors.name[0] }}
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Category Modal-->


                                    <div class="col-md-3">
                                        <label for="validationBrand" class="form-label">Brand</label>
                                        <i class="bi bi-patch-plus btn text-primary" type="button" data-bs-toggle="modal" data-bs-target="#brandModal"></i>
                                        <v-select v-model="form.product.brand_id" label="name" :options="brand" :reduce="brand => brand.id" @option:selected="modelByBrand"></v-select>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>

                                    <!-- Brand Modal-->
                                    <div class="modal fade" id="brandModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Brand</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" @submit.prevent="storeBrand">
                                                        <div class="col-md-12">
                                                            <label for="validationCustom01" class="form-label"> Name</label>
                                                            <input type="text" class="form-control" id="validationCustom01" v-model="brandData.name">
                                                            <div class="valid-feedback" v-if="errors.name">
                                                                {{ errors.name[0] }}
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Brand Modal-->

                                    <div class="col-md-3">
                                        <label for="validationModel" class="form-label">Model</label>
                                        <i class="bi bi-patch-plus btn text-primary" type="button" data-bs-toggle="modal" data-bs-target="#modelModal"></i>
                                        <v-select v-model="form.product.model_id" label="name" :options="model" :reduce="model => model.id" ></v-select>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>

                                    <!-- Model Modal-->
                                    <div class="modal fade" id="modelModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Brand</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" @submit.prevent="storeModels">
                                                        <div class="col-md-12">
                                                            <label for="validationCustom01" class="form-label"> Name</label>
                                                            <input type="text" class="form-control" id="validationCustom01" v-model="modelData.name">
                                                            <div class="valid-feedback" v-if="errors.name">
                                                                {{ errors.name[0] }}
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Model Modal-->

                                    <div class="col-md-3">
                                        <label for="validationspecifications" class="form-label">specifications</label>
                                        <input type="text" class="form-control" id="validationspecifications" v-model="form.product.specifications" required>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <label for="validationQty" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="validationQty" v-model="form.product.qty" required>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="validationunit_price" class="form-label">Unit Price</label>
                                        <input type="number" class="form-control" id="validationunit_price" v-model="form.product.unit_price" required>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="validationsales_price" class="form-label">Sales Price</label>
                                        <input type="number" class="form-control" id="validationsales_price" v-model="form.product.sales_price" required>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" v-model="isAvailable">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Available Serial
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3" v-if="isAvailable">
                                    <div class="col-md-8">
                                        <label for="validationSalesSerialNo" class="form-label">Serial No</label>

                                        <input type="text" class="form-control" id="validationSalesSerialNo" v-model="form.product.serial" @keyup.,="serialAdd">

                                        <div class="row">
                                            <div class="col-12">
                                                <span v-for="serial in form.product.serial_arr"><small>{{serial}},</small></span>
                                            </div>
                                        </div>

                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationwarranty" class="form-label">warranty</label>
                                        <input type="number" class="form-control" id="validationwarranty" v-model="form.product.warranty" placeholder="In day" required>
                                        <div class="valid-feedback" v-if="errors.nid">
                                            {{ errors.nid[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                Product List
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="max-width:200px">Items</th>
                                            <th class="text-end">Unit Price</th>
                                            <th class="text-end">Qty</th>
                                            <th class="text-end">Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in productList" :keys="index">
                                        <td>{{ ++index }}</td>
                                        <td style="max-width:200px">

                                            {{item.category.name}} {{item.brand.name}} {{item.model.name}} {{ item.specifications}}<br>
                                           [<span v-for="serial in item.serial_arr"><small>{{serial}},</small></span>]
                                        </td>
                                        <td class="text-end">{{item.unit_price}}</td>
                                        <td class="text-end">{{item.qty}}</td>
                                        <td class="text-end">{{item.total_amount}}</td>
                                        <td><a @click="removeProduct(item.id)" class="btn btn-danger btn-sm m-1" title="Remove"><i class="bi bi-trash-fill"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <button class="btn btn-primary" type="button" @click="storePurchase">Save</button>
                        </div>
                    </form>
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
import axios from 'axios'

export default{
    components: {Header:Header, Sidebar: Sidebar, Footer: Footer},
    created(){
        if(!User.loggedIn()){
            this.$router.push('/login')
        }
        this.loadCategories();
        this.loadBrand();
        this.loadModel();
        this.loadSuppliers();
        this.loadProductList();
    },
    data(){
        return{
            form: {
                invoice: {
                    invoice_no: '',
                    supplier_id: '',
                    date: '',
                },
                product:{
                    category_id:'',
                    brand_id: '',
                    model_id:'',
                    specificationss:'',
                    serial:'',
                    serial_arr:[],
                    warranty:'',
                    qty:'',
                    unit_price: '',
                    sales_price: '',
                    total_amount: ''
                }
            },
            productList: '',
            category:{
                name:''
            },
            supplier: {
                name:'',
                mobile:'',
                email:'',
                address:'',
                web:''
            },
            brandData: {
                name:''
            },
            modelData: {
                name:''
            },
            isAvailable: false,
            errors:{},
            categories:[],
            brand:[],
            model:[],
            suppliers:[],
            supplierId:'',
        }
    },

    methods:{
        storeCategory(){
            axios.post('api/category/store', this.category)
                .then(
                    res => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Category has been added successfully.'
                        })
                        this.loadCategories();
                    }
                )
                .catch(
                    error => {
                        this.errors = error.response.data.errors;
                        // console.log(this.errors.full_name[0]);
                    }
                )
        },
        storeSupplier(){
            axios.post('api/supplier/store', this.supplier)
                .then(
                    res => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Supplier has been added successfully.'
                        })
                        this.loadSuppliers();
                    }

                )
                .catch(
                    error => {
                        this.errors = error.response.data.errors;
                        // console.log(this.errors.full_name[0]);
                    }
                )
        },
        storeBrand(){
            axios.post('api/brand/store', this.brandData)
                .then(
                    res => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Brand has been added successfully.'
                        })
                        this.loadBrand();
                    }

                )
                .catch(
                    error => {
                        this.errors = error.response.data.errors;
                        // console.log(this.errors.full_name[0]);
                    }
                )
        },
        storeModels(){
            axios.post('api/models/store', this.modelData)
                .then(
                    res => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Models has been added successfully.'
                        })
                        this.loadModel();
                    }
                )
                .catch(
                    error => {
                        this.errors = error.response.data.errors;
                    }
                )
        },
        serialAdd(){
            this.form.product.serial_arr.push(this.form.product.serial.replace(',',''));
            this.form.product.qty = this.form.product.serial_arr.length;
            this.form.product.serial = ''
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
                    this.brand = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        loadModel(){
            axios.get('/api/models')
                .then(res => {
                    this.model = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        loadSuppliers(){
            axios.get('/api/supplier')
                .then(res => {
                    this.suppliers = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        loadProductList(){
            axios.get('/api/temp_purchase')
                .then(res => {
                    this.productList = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        storeTempPurchase(){
            this.form.product.total_amount = this.form.product.qty * this.form.product.unit_price;
            axios.post('api/temp_purchase/store', this.form)
                .then(res => {
                    this.loadProductList();

                    this.form.product.category_id = ''
                    this.form.product.brand_id =  ''
                    this.form.product.model_id = ''
                    this.form.product.specifications =''
                    this.form.product.serial = ''
                    this.form.product.serial_arr = []
                    this.form.product.warranty = ''
                    this.form.product.qty = ''
                    this.form.product.unit_price = ''
                    this.form.product.sales_price =  ''
                })
                .catch(err => {
                    console.log(err);
                })
        },
        storePurchase(){
            axios.post('api/purchase/store', this.form.invoice)
                .then(res => {
                    this.loadProductList();
                    this.form.invoice.invoice_no = ''
                    this.form.invoice.supplier_id = ''
                    this.form.invoice.date = ''

                    console.log(res.data);

                    Toast.fire({
                        icon: 'success',
                        title: 'Purchase has been added successfully.'
                    })
                })
                .catch(err => console.log(err))
        },
        removeProduct(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                axios.delete('/api/temp_purchase/' + id)
                    .then(() => {
                        this.productList = this.productList.filter(product => {
                            return product.id != id;
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'allBrand'})
                    })
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        },

        brandByCategory(category){
          axios.get('/api/getBrandByCategory/'+category.id)
            .then(res => {
                this.brand = res.data;
            })
            .catch(err => {
                console.log(err);
            })
        },
        modelByBrand(brand){
          axios.get('/api/getModelByBrand/'+brand.id)
            .then(res => {
                this.model = res.data;
            })
            .catch(err => {
                console.log(err);
            })
        },
    }

}
</script>
