import { writable } from "svelte/store";

export const flashMessage = writable<{
    success: string;
    error: string;
}>({
    success: '',
    error: '',
});
