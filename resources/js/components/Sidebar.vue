<template>
    <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <router-link class="nav-link " to="/">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </router-link>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#purchas-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-menu-button-wide"></i><span>Purchase</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="purchas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/purchase-create">
                    <i class="bi bi-circle"></i><span>Add New</span>
                </router-link>
            </li>
            <li>
                <router-link to="/purchases">
                    <i class="bi bi-circle"></i><span>All Purchase</span>
                </router-link>
            </li>
        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#employee-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-person-bounding-box"></i><span>Employee</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="employee-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/employee-create">
                    <i class="bi bi-circle"></i><span>Add New</span>
                </router-link>
            </li>
            <li>
                <router-link to="/employees">
                    <i class="bi bi-circle"></i><span>All Employee</span>
                </router-link>
            </li>

        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#supplier-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-people-fill"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="supplier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/supplier-create">
                    <i class="bi bi-circle"></i><span>Add New</span>
                </router-link>
            </li>
            <li>
                <router-link to="/supplier">
                    <i class="bi bi-circle"></i><span>All Supplier</span>
                </router-link>
            </li>

        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-people-fill"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/category-create">
                    <i class="bi bi-circle"></i><span>Add New</span>
                </router-link>
            </li>
            <li>
                <router-link to="/category">
                    <i class="bi bi-circle"></i><span>All Categories</span>
                </router-link>
            </li>

        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#brand-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-people-fill"></i><span>Brand</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="brand-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/brand-create">
                    <i class="bi bi-circle"></i><span>Add New</span>
                </router-link>
            </li>
            <li>
                <router-link to="/brand">
                    <i class="bi bi-circle"></i><span>All Brand</span>
                </router-link>
            </li>

        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#models-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-people-fill"></i><span>Models</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="models-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/models-create">
                    <i class="bi bi-circle"></i><span>Add New</span>
                </router-link>
            </li>
            <li>
                <router-link to="/models">
                    <i class="bi bi-circle"></i><span>All Models</span>
                </router-link>
            </li>

        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" data-bs-target="#stock-nav" data-bs-toggle="collapse" to="#">
            <i class="bi bi-people-fill"></i><span>Stock</span><i class="bi bi-chevron-down ms-auto"></i>
        </router-link>
        <ul id="stock-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <router-link to="/stocks">
                    <i class="bi bi-circle"></i><span>Stocks</span>
                </router-link>
            </li>

        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="forms-elements.html">
                    <i class="bi bi-circle"></i><span>Form Elements</span>
                </a>
            </li>
            <li>
                <a href="forms-layouts.html">
                    <i class="bi bi-circle"></i><span>Form Layouts</span>
                </a>
            </li>
            <li>
                <a href="forms-editors.html">
                    <i class="bi bi-circle"></i><span>Form Editors</span>
                </a>
            </li>
            <li>
                <a href="forms-validation.html">
                    <i class="bi bi-circle"></i><span>Form Validation</span>
                </a>
            </li>
        </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="tables-general.html">
                    <i class="bi bi-circle"></i><span>General Tables</span>
                </a>
            </li>
            <li>
                <a href="tables-data.html">
                    <i class="bi bi-circle"></i><span>Data Tables</span>
                </a>
            </li>
        </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="charts-chartjs.html">
                    <i class="bi bi-circle"></i><span>Chart.js</span>
                </a>
            </li>
            <li>
                <a href="charts-apexcharts.html">
                    <i class="bi bi-circle"></i><span>ApexCharts</span>
                </a>
            </li>
            <li>
                <a href="charts-echarts.html">
                    <i class="bi bi-circle"></i><span>ECharts</span>
                </a>
            </li>
        </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="icons-bootstrap.html">
                    <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
                </a>
            </li>
            <li>
                <a href="icons-remix.html">
                    <i class="bi bi-circle"></i><span>Remix Icons</span>
                </a>
            </li>
            <li>
                <a href="icons-boxicons.html">
                    <i class="bi bi-circle"></i><span>Boxicons</span>
                </a>
            </li>
        </ul>
    </li><!-- End Icons Nav -->

    <li class="nav-item">
        <router-link class="nav-link collapsed" to="logout">
            <i class="bi bi-power"></i>
            <span>Sign Out</span>
        </router-link>
    </li><!-- End Blank Page Nav -->

</ul>

</aside><!-- End Sidebar-->
</template>
<script setup>
</script>
