<!-- src/routes/about.svelte -->
<script>
    let name;

    fetch('http://pitclub.bisapp.slim/api')
        .then((response) => response.json())
        .then((data) => {
            name = data
        })
</script>
<main>
    {name}
</main>

