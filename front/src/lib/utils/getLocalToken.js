export function getLocalToken() {
    return typeof window !== 'undefined' ? localStorage.getItem('myDear') : null;
}