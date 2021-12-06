<!-- src/routes/login.svelte -->
<script>
    let email;
    let password;
    let result;

     async function doLogin() {
        const response = await fetch('http://pitclub.bisapp.slim/api/login', {
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
    }
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
                            <div class="form-outline mb-4">
                                <input bind:value={email} type="email" id="form1Example1" class="form-control"/>
                                <label class="form-label" for="form1Example1">Адрес почты</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input bind:value={password} type="password" id="form1Example2" class="form-control"/>
                                <label class="form-label" for="form1Example2">Пароль</label>
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="form1Example3"
                                               checked/>
                                        <label class="form-check-label" for="form1Example3">
                                            Запомнить
                                        </label>
                                    </div>
                                </div>

                                <div class="col text-center">
                                    <!-- Simple link -->
                                    <a href="#!">Забыли пароль</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button on:click|preventDefault={doLogin} type="submit" class="btn btn-primary btn-block">Войти</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
</header>
<!--Main Navigation-->
<pre>
{result}
</pre>
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