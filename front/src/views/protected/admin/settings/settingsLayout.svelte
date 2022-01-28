<script>
    import {Route} from "svelte-router-spa";
    import SecondSidebar from './secondSidebar.svelte';
    import TopNav from './topNav.svelte';

    export let currentRoute;
    export let currentUser = {};

</script>
<style>
    .second_sidebar {
        width:250px;
    }
</style>
<div class="second_sidebar col-2 px-0 d-none d-md-block">
    <SecondSidebar />
</div>
<div class="col-12 col-md-6 px-0">
    <TopNav />
    <Route {currentRoute}/>
</div>