import { createRouter, createWebHistory} from "vue-router";



import index from '../components/index.vue'
import notFound from '../components/NotFound.vue'
import login from '../components/Auth/login.vue'
import logout from '../components/Auth/logout.vue'
import register from '../components/Auth/register.vue'

//Employee components
import createEmployee from '../components/Employee/create.vue'
import allEmployee from '../components/Employee/index.vue'
import editEmployee from '../components/Employee/edit.vue'

//Purchase components
import createPurchase from '../components/Purchase/create.vue'
import editPurchase from '../components/Purchase/edit.vue'
import allPurchase from '../components/Purchase/index.vue'
//Supplier components
import createSuppler from '../components/Supplier/create.vue'
import allSuppler from '../components/Supplier/index.vue'
import editSuppler from '../components/Supplier/edit.vue'

//Category components
import createCategory from '../components/Category/create.vue'
import allCategory from '../components/Category/index.vue'
import editCategory from '../components/Category/edit.vue'

//Brand components
import createBrand from '../components/Brand/create.vue'
import allBrand from '../components/Brand/index.vue'
import editBrand from '../components/Brand/edit.vue'

//Models components
import createModels from '../components/Models/create.vue'
import allModels from '../components/Models/index.vue'
import editModels from '../components/Models/edit.vue'

//Stocks components
import Stocks from '../components/Stock/index.vue'

const routes =[
    { path: '/login', component: login, name: 'loign'},
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/register', component: register, name: 'register' },
    { path: '/', component: index, name: 'home' },
    //Employee routes
    { path: '/employee-create', component: createEmployee, name: 'createEmployee'},
    { path: '/employees', component: allEmployee, name: 'allEmployee'},
    { path: '/employee/:id', component: editEmployee, name: 'editEmployee'},

    //Purchase routes
    { path: '/purchase-create', component: createPurchase, name: 'createPurchase'},
    { path: '/purchases', component: allPurchase, name: 'allPurchase'},
    { path: '/purchases/:id', component: editPurchase, name: 'editPurchase'},

    //Supplier routes
    {path: '/supplier-create', component: createSuppler, name:'createSupplier'},
    {path: '/supplier', component: allSuppler, name:'allSupplier'},
    {path: '/supplier/:id', component: editSuppler, name:'editSupplier'},

    //Category routes
    {path: '/category-create', component: createCategory, name:'createCategory'},
    {path: '/category', component: allCategory, name:'allCategory'},
    {path: '/category/:id', component: editCategory, name:'editCategory'},

    //Brand routes
    {path: '/brand-create', component: createBrand, name:'createBrand'},
    {path: '/brand', component: allBrand, name:'allBrand'},
    {path: '/brand/:id', component: editBrand, name:'editBrand'},

    //Models routes
    {path: '/models-create', component: createModels, name:'createModels'},
    {path: '/models', component: allModels, name:'allModels'},
    {path: '/models/:id', component: editModels, name:'editModels'},

    //Stocks routes
    {path: '/stocks', component: Stocks, name:'Stocks'},

    { path: '/:pathMatch(.*)*', component: notFound }
]


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
