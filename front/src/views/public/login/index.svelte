<script>
    import {createEventDispatcher, onMount} from 'svelte';
    import {navigateTo} from "svelte-router-spa";
    import {API} from "../../../settings";
    import {checkAuthLogin} from "../../../lib/utils/checkAuthLogin";

    const dispatch = createEventDispatcher();

    let email;
    let password;
    let token = '';
    let result = {
        success: "",
        message: "",
        token: "",
    };

    async function doLogin() {
        const response = await fetch(API.url + API.version + 'login_q', {
            method: "POST",
            body: JSON.stringify({
                email,
                password
            }),
            headers: {
                'Content-Type': 'application/json',
            },
        });
        result = await response.json();
        if (response.ok && result.success === true) {
            localStorage.setItem('myDear', result.token);
            navigateTo('admin');
        }
    }

    function resetMessage() {
        return result = {
            message: ""
        };
    }

    onMount(function () {
        checkAuthLogin();
    });
</script>


<style>
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

</style>


<body>
<main class="form-signin">
    <form>
        <h1 class="h3 mb-3 fw-normal">Пожалуйста войдите</h1>

        <div class="form-floating">
            <input type="email" bind:value={email} class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Ваша почта</label>
        </div>
        <div class="form-floating">
            <input type="password" bind:value={password} class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Пароль</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" on:click|preventDefault={doLogin}> Войти </button>
        <p class="mt-5 mb-3 text-muted">Apxat &copy; 2017–2022</p>
    </form>
</main>
</body>

