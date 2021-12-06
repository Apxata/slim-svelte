<!-- src/routes/about.svelte -->
<script>

    let name;
    name = await fetch('http://pitclub.bisapp.slim/api/home').then(r => r.json());

</script>
<main>
    {name}
</main>

