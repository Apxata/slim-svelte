import Login from "../../views/public/login/index.svelte";
import PublicLayout from '../../views/public/layout.svelte';

// const publicRoutes = [
//   {
//     name: "/",
//     component: PublicLayout,
//   },
//   { name: 'login', component: Login, layout: PublicLayout },
// ];
//
// export { publicRoutes };


const routes = [
  {
    name: '/',
    component: PublicLayout,
  },
  { name: 'login', component: Login, layout: PublicLayout },
]

export { routes }
