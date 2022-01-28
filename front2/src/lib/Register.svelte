<script>
    import {createEventDispatcher} from 'svelte';

    const dispatch = createEventDispatcher();

    let email;
    let password;
    let name;
    let error;

    async function register() {
        error = '';
        try {
            const res = await fetch('/api/register_simple', {
                method: 'POST',
                body: JSON.stringify({
                    email,
                    password,
                    name
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            if (res.ok) {
                dispatch('success');
            } else {
                error = 'Error';
            }
        } catch (err) {
            console.log(err)
            error = 'Error catch'
        }
    }
</script>

<h1>Register</h1>
<input type="email" bind:value={email} placeholder="Enter email">
<input type="password" bind:value={password}
       placeholder="Enter password">
<input type="text" bind:value={name}
       placeholder="Enter name">
{#if error}<p>{error}</p>{/if}>
<button on:click={register}>Register</button>