<!-- src/routes/login.svelte -->
<script>

    let email;
    let password;
    let password2;
    let result;
    let errorPassword = '';

    function check_password() {
        if(password === password2) {
            return true;
        } else {
            return false;
        }
    }

     async function doRegister() {
        if(check_password() === true) {
            const response = await fetch('http://pitclub.bisapp.slim/api/register', {
                method: "POST",
                body: JSON.stringify({
                    email,
                    password
                }),
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            const json = await response.json();
            result = JSON.stringify(json);
        } else {
            errorPassword = 'Пароли не совпадают';
        }
    }

    const onKeyPress = e => {
        errorPassword ='';
    };

</script>
<header>
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

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-8">
                        <form class="bg-white  rounded-5 shadow-5-strong p-5">
                            <!-- Email input -->
                            {#if result }
                            <div class="alert alert-secondary" role="alert">
                                {result }
                            </div>
                            {/if}
                            <div class="form-outline mb-4">
                                <input bind:value={email} type="email" id="form1Example1" class="form-control"/>
                                <label class="form-label" for="form1Example1">Адрес почты</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input bind:value={password} type="password" id="form1Example2" class="form-control"/>
                                <label class="form-label" for="form1Example2">Пароль</label>
                            </div>

                            <!-- Password verify -->
                            <div class="form-outline mb-4">
                                <input on:keypress={onKeyPress} bind:value={password2}  type="password" id="form2Example2" class="form-control"/>
                                <label class="form-label" for="form2Example2">Введите пароль повторно</label>
                                {#if errorPassword }
                                <div class="alert alert-danger" role="alert">
                                    {errorPassword}
                                </div>
                                {/if}
                            </div>

                             <!-- Submit button -->
                            <button on:click|preventDefault={doRegister} type="submit" class="btn btn-primary btn-block">Зарегаться</button>
                            <div class="row mt-4">
                                <div class="col text-center">
                                    <!-- Simple link -->
                                    <a href="login">Войти</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
</header>
<!--Main Navigation-->
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