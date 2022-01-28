import {writable} from 'svelte/store';

const storedAuth = localStorage.getItem("auth");
export const auth = writable(storedAuth);
auth.subscribe(value => {
    localStorage.setItem("auth", value === 'false' ? 'false' : 'true');
});
