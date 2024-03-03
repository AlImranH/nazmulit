<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <!-- Start main section -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Stocks</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Stock</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Stock

                        </div>
                        <div class="card-body mt-3">
                            <label for="search">Search</label>
                            <input class="form-control mb-2" id="search" v-model="searchItem">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col" class="text-end">Qty</th>
                                    <th scope="col" class="text-end">Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(stock, index) in stocks" :keys="index">
                                    <th scope="row">{{ ++index }}</th>
                                    <td>
                                        {{stock.category.name}} {{stock.brand.name}} {{stock.model.name}} {{stock.specifications}} <br>
                                    </td>
                                    <td class="text-end">{{ stock.qty }}</td>
                                    <td class="text-end">{{ stock.total_amount }}</td>

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
            stocks: [],
        }
    },

    created(){
        if(!User.loggedIn()){
            this.$router.push('/login')
        }
        this.allStocks()
    },
    components: {Header:Header, Sidebar: Sidebar, Footer: Footer},
    methods: {
        allStocks(){
            axios.get('/api/stocks')
                .then(res => {
                    console.log(res.data);
                    this.stocks = res.data;
                })
                .catch(
                    error => console.log(error.response)
                )
        },
    }
}
</script>
