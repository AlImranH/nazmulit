import './bootstrap';

import '../assets/vendor/apexcharts/apexcharts.min';
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min';
import '../assets/vendor/chart.js/chart.umd';
import '../assets/vendor/echarts/echarts.min';
import '../assets/vendor/quill/quill.min';
import '../assets/vendor/simple-datatables/simple-datatables';
import '../assets/vendor/tinymce/tinymce.min';
import '../assets/vendor/php-email-form/validate';
import '../assets/js/main.js';


import { createApp } from 'vue';
import router from './router/index.js';

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

import User from './helpers/User.js'
window.User = User;

//start sweet alert2
import Swal from 'sweetalert2'
window.Swal = Swal






const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Toast = Toast
//end sweet alert2

import app from './components/App.vue';



const App = createApp({})

App.component("app", app);
App.component("v-select", vSelect)
App.use(router);

App.mount("#app")
