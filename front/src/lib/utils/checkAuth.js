import {API} from "../../settings";
import {navigateTo} from "svelte-router-spa";
import {getLocalToken} from "./getLocalToken";

export async function checkAuth() {

    let result;

    const token = getLocalToken();

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
    if (result.success === false) {
       navigateTo('login')
    }
}