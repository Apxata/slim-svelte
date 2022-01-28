export function Authenticate()
{
    const auth = typeof window !== 'undefined' ? localStorage.getItem('auth') : null

    if (auth == 'authorized') {
        return true;
    } else {
        return false;
    }
}
