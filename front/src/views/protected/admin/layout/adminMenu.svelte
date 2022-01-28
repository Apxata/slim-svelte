<style>
    .first-sidebar {
        width: 100px;
    }
    .nav-link {
        border-radius: 0px !important;
        transition: all 0.5s;
        width: 100px;
        display: flex;
        flex-direction: column
    }

    .nav-link small {
        font-size: 12px
    }

    .nav-link:hover {
        background-color: #52525240 !important
    }

    .nav-link .fa {
        transition: all 1s;
        font-size: 20px
    }

    .nav-link:hover .fa {
        transform: rotate(360deg)
    }

</style>
<!--  mobile menu bar-->
<!-- icon menu  -->
        <div class="first-sidebar">
            <div class="d-flex flex-column flex-shrink-0 bg-light vh-100">
                <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                    <li class="nav-item"> <a href="#" class="nav-link active py-3 border-bottom"> <i class="fa fa-home"></i> <small>Главная</small> </a> </li>
                    <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-dashboard"></i> <small>Дашборд</small> </a> </li>
                    <li> <a href="/admin/consumables" class="nav-link py-3 border-bottom"> <i class="fa fa-envelope"></i> <small>Расходники</small> </a> </li>
                    <li> <a href="/admin/settings" class="nav-link py-3 border-bottom"> <i class="fa fa-cog"></i> <small>Настройки</small> </a> </li>
                    <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>CRM</small> </a> </li>
                    <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>Логи</small> </a> </li>
                </ul>
            </div>
        </div>


