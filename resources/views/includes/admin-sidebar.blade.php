<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/admin" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fab fa-product-hunt"></i>
                <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>List of Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/product/create" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>Add Product</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/admin/categories" class="nav-link">
                <i class="nav-icon fas fa-compress"></i>
                <p>Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Orders</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin" class="nav-link">
                <i class="nav-icon fas fa-money-bill-alt"></i>
                <p>Payments</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/auth/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->