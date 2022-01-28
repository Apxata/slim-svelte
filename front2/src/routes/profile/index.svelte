<script>
    async function getData() {
        let error;
        error = '';
        try {
            const res = await fetch('/api/v1/profile', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            if (res.ok) {

            } else {

                error = 'Error';
            }
        } catch (err) {
            console.log(err);
            error = 'Error catch';
        }
    }
    getData();
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
    <h1>Profile</h1>

</main>