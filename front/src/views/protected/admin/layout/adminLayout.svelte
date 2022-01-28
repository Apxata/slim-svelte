<script>
    import {Route} from "svelte-router-spa";
    import AdminMenu from './adminMenu.svelte';
    import {onMount} from "svelte";
    import {checkAuth} from "../../../../lib/utils/checkAuth";

    export let currentRoute;
    export let currentUser = {};

    onMount(function () {
        checkAuth();
    });

</script>
<style>
  .first_sidebar {
    width:100px;
  }
</style>
<section class="container-fluid">
  <div class="row">
    <div class="first_sidebar col-1 px-0 d-none d-md-block">
      <AdminMenu />
    </div>
      <Route {currentRoute}/>
  </div>
  </section>