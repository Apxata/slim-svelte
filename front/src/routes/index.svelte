<script>
    import Login from '$lib/Login.svelte';
    import Register from '$lib/Register.svelte';
    import {goto} from "$app/navigation";

    function redirectToProfile() {
        goto('/profile')
    }

</script>

    <style>
        #intro {
            background-color: black;
            height: 100vh;
        }

        /* Height for devices larger than 576px */
        @media (min-width: 992px) {
            #intro {
                margin-top: -58.59px;
            }
        }

        .navbar .nav-link {
            color: #fff !important;
        }
    </style>

<main>
    <h1>Auth with Cookie in SvelteKit</h1>
    <Login on:succeess={redirectToProfile}></Login>
    <Register on:succeess={redirectToProfile}></Register>

</main>
<!--Footer-->
<footer class="bg-light text-lg-start">

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright:
        <a class="text-dark" href="https://apxat.ru">Apxat production</a>
    </div>
    <!-- Copyright -->
</footer>
<!--Footer-->