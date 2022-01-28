<!-- src/routes/admin/index.svelte -->
<script>
    import {goto} from "$app/navigation";

    const auth = typeof window !== 'undefined' ? localStorage.getItem('Auth') : null

    if (auth === null) {
        goto('/login')
    }
</script>
<h1>Welcome to SvelteKit11</h1>
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>
