import {API} from "../../settings";
import {navigateTo} from "svelte-router-spa";

export async function checkAuthLogin() {

    let result;

    const token = typeof window !== 'undefined' ? localStorage.getItem('myDear') : null;

    if(token === null) {
        return false;
    }

    const response = await fetch(API.url + 'auth-status', {
        method: "POST",
        body: JSON.stringify({
            token
        }),
        headers: {
            'Content-Type': 'application/json',
        },
    });
    result = await response.json();
    if( response.ok && result.success === true) {
        navigateTo('admin');
    }
}