<script>
    import { Route } from 'svelte-router-spa'
    export let currentRoute
</script>

<div class="app">
    <section class="section">
        <Route {currentRoute}/>
    </section>
</div>