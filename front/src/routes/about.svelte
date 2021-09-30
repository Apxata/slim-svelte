<!-- src/routes/about.svelte -->
<script>
    let characterName;

    fetch('http://pitclub.bisapp.slim/')
        .then((response) => response.json())
        .then((character) => {
            characterName = character.name;
        })
</script>

<svelte:head>
    <title>{characterName}</title>
</svelte:head>

<h1>About this site</h1>
<p>TODO...</p>

