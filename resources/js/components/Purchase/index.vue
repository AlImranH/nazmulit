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
                            All Purchase
                            <router-link to="/purchase-create" class="btn btn-primary btn-sm float-end">Add Purchase</router-link>
                        </div>
                        <div class="card-body mt-3">
                            <label for="search">Search</label>
                            <input class="form-control mb-2" id="search" v-model="searchItem">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(purchases, index) in filterSearch" :keys="index">
                                        <th scope="row">{{ ++index }}</th>
                                        <td>
                                            <router-link to="#" @click="purchaseDetails(purchases.invoice_no)" data-bs-toggle="modal" data-bs-target="#detailsModal">{{ purchases.invoice_no }}</router-link>
                                        </td>
                                        <td>{{ purchases.supplier.name }}</td>
                                        <td>{{ purchases.total_amount }}</td>
                                        <td>{{ purchases.date }}</td>
                                        <td>
                                            <router-link :to="{name:'editPurchase', params:{id: purchases.id}}" class="btn btn-warning btn-sm m-1"><i class="bi bi-pencil"></i></router-link>
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

    <!-- Details Modal-->
    <div class="modal fade modal-lg" id="detailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Purchase Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="max-width: 200px;">Items</th>
                            <th class="text-end" >Unit Price</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(detail, index) in details" :keys="index">
                            <th scope="row">{{ ++index }}</th>
                            <td style="max-width: 300px; min-width: 200px;">
                                    {{detail.category.name}} {{detail.brand.name}} {{detail.model.name}} {{detail.specifications}} <br>
                                [<span ><small v-for="serial in detail.serial_arr">{{serial}} ,</small></span>]
                            </td>
                            <td class="text-end" style="max-width: 100px;">
                                    {{detail.unit_price}}
                            </td>
                            <td class="text-end" style="max-width: 100px;">
                                    {{detail.qty}}
                            </td>
                            <td class="text-end" style="max-width: 100px;">
                                    {{detail.total_amount}}
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Details Modal-->

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

            purchases: [],
            details: [],
            searchItem: '',
        }
    },
    computed:{
        filterSearch(){
            return this.purchases.filter(purchase => {
                return purchase.invoice_no.match(this.searchItem);
            })
        }
    },
    created(){
        if(!User.loggedIn()){
            this.$router.push('/login')
        }
        this.allPurchases()
    },
    components: {Header:Header, Sidebar: Sidebar, Footer: Footer},
    methods: {
        allPurchases(){
            axios.get('/api/purchase')
            .then(res => {
                this.purchases = res.data;
            })
            .catch(
                error => console.log(error.response)
            )
        },

        purchaseDetails(invoiceNo){
            axios.get('/api/purchase/'+invoiceNo)
                .then(res => {
                    this.details = res.data;
                })
                .catch(error => {
                    console.log(error.response)
                })
        },

        editPurchase(id){
            axios.get('/api/purchase/edit/'+id)
            .then(res =>{
                console.log(res.data);
            })
            .catch(err=>{
                console.log(err);
            })
        }
    }
}
</script>
