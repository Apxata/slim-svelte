<script>
    import { Navigate } from 'svelte-router-spa'

</script>

<style>
    .second_sidebar {
        width: 250px;
        background-color: #f5f5f5;
    }
    .bi {
        vertical-align: -.125em;
        pointer-events: none;
        fill: currentColor;
    }

    .btn-toggle-nav a {
        display: inline-flex;
        padding: .1875rem .5rem;
        margin-top: .125rem;
        margin-left: 1.25rem;
        text-decoration: none;
    }
    .btn-toggle-nav a:hover,
    .btn-toggle-nav a:focus {
        background-color: #d2f4ea;
    }

</style>
<!-- sidebar  -->
<div class="second_sidebar">
    <div class="d-flex flex-column flex-shrink-0 pt-3 vh-100">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">PitBikeClub</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">

            <li>
                <a href="/admin/settings" class="nav-link link-dark">
                    Все настройки
                </a>
                <a href="/admin/settings/users" class="nav-link link-dark">
                    Пользователи
                </a>
            </li>
        </ul>
    </div>
</div>