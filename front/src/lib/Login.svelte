<script>
    import {createEventDispatcher} from 'svelte';

    const dispatch = createEventDispatcher();

    let email;
    let password;
    let error;

    async function login() {
        error = '';
        try {
            const res = await fetch('/api/login_q', {
                method: 'POST',
                body: JSON.stringify({
                    email,
                    password
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
            console.log(err);
            error = 'Error catch';
        }
    }
</script>

<h1>Login</h1>
<input type="email" bind:value={email} placeholder="Enter email">
<input type="password" bind:value={password}
       placeholder="Enter password">
{#if error}<p>{error}</p>{/if}>
<button on:click={login}>Login</button>