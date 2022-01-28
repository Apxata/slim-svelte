import PublicLayout from "./views/public/layout.svelte";
import main from "./views/public/main/index.svelte";
import Login from "./views/public/login/index.svelte";
import AdminMain from './views/protected/admin/main/index.svelte';
import AdminLayout from './views/protected/admin/layout/adminLayout.svelte';
import AdminConsumableLayout from './views/protected/admin/consumables/adminConsumableLayout.svelte';
import UserList from './views/protected/admin/settings/userList.svelte';
import Consumption from './views/protected/admin/consumables/acceptance.svelte';
import SettingsLayout from './views/protected/admin/settings/settingsLayout.svelte';
import Settings from './views/protected/admin/settings/settings.svelte';
import Catalogue from './views/protected/admin/consumables/catalogue.svelte';
import ListItem from './views/protected/admin/consumables/list-items.svelte';
import {getLocalToken} from "./lib/utils/getLocalToken";
import {checkAuth} from "./lib/utils/checkAuth";

function checkRole() {

    return true;

}

const routes = [
    {
        name: '/',
        component: main,
        layout: PublicLayout,
    },
    { name: '/login', component: Login },
    {
        name: 'admin',
        component: AdminLayout,
        onlyIf: { guard: checkRole, redirect: '/login' },
        nestedRoutes: [
            { name: 'index', component: AdminMain },
            {
                name: 'settings',
                component: SettingsLayout,
                nestedRoutes: [
                    { name: 'index', component: Settings },
                    { name: 'users', component: UserList },
                ],
            },
            {
                name: 'consumables',
                component: AdminConsumableLayout,
                nestedRoutes: [
                    { name: 'index', component: Consumption },
                    { name: 'catalogue', component: Catalogue },
                ],
            },
        ],
    },
]

export { routes };
