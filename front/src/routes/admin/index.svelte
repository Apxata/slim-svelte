<!-- src/routes/admin/index.svelte -->
<script context="module">
    let token;
    token = localStorage.getItem('MyDear');

</script>
<h1>Welcome to SvelteKit11</h1>
{token}
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>
