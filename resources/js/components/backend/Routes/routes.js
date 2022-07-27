// import Home from './pages/Home'
// import Register from './pages/Register'
// import Login from '../Login/login_body.vue'
const Login = () =>
    import ( /* webpackChunkName: "Login" */ '../Login/login_body.vue')
    // import Login from './components/backend/Login/login_body.vue'
    // import Dashboard from './pages/user/Dashboard'
    // import AdminDashboard from './pages/admin/Dashboard'
const Home = () =>
    import ( /* webpackChunkName: "Home" */ '../Admin/home_component.vue')
const Role = () =>
    import ( /* webpackChunkName: "Role" */ '../Admin/role_component.vue')
const permission = () =>
    import ( /* webpackChunkName: "permission" */ '../Admin/permission_component.vue')
const assign_role_model = () =>
    import ( /* webpackChunkName: "assign_role_model" */ '../Admin/assign_role_model.vue')
const assign_permission_model = () =>
    import ( /* webpackChunkName: "assign_permission_model" */ '../Admin/assign_permission_model.vue')
const users = () =>
    import ( /* webpackChunkName: "users" */ '../Admin/users.vue')
const user_update = () =>
    import ( /* webpackChunkName: "user_update" */ '../Admin/user_update.vue')
const password_reset = () =>
    import ( /* webpackChunkName: "password_reset" */ '../Admin/password_reset.vue')
    // import Home from '../Admin/home_component.vue'
    // import Role from '../Admin/role_component.vue'
    // import permission from '../Admin/permission_component.vue'
    // import assign_role_model from '../Admin/assign_role_model.vue'
    // import assign_permission_model from '../Admin/assign_permission_model.vue'
    // import users from '../Admin/users.vue'
    // import user_update from '../Admin/user_update.vue'
    // import password_reset from '../Admin/password_reset.vue'
    // import login_body from './components/login/login_body.vue'

// Buyer module
const buyer_manage = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/buyer/manage.vue')
const buyer_create = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/buyer/create.vue')
const buyer_edit = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/buyer/edit.vue')


// Seller module
const seller_manage = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/seller/manage.vue')
const seller_create = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/seller/create.vue')
const seller_edit = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/seller/edit.vue')


const connect_seller_buyer = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/connect_seller_buyer.vue')
const data_count = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/data_count.vue')
const memo_page = () => import ( /* webpackChunkName: "permission" */ '../Admin/buyer_seller/memo_page.vue')

export const routes = [{
        path: '/login',
        name: 'admin_login',
        component: Login,
        meta: {
            auth: false
        }
    },
    { path: '/', redirect: { name: 'admin_login' } },
    {
        path: '/home',
        name: 'admin_home',
        component: Home,
        meta: {
            auth: true
        }
    },
    { path: '/role', name: 'role', component: Role },
    { path: '/permission', name: 'permission', component: permission },
    { path: '/assign_role_to_user', name: 'assign_role_to_user', component: assign_role_model },
    { path: '/assign_permission_to_user', name: 'assign_permission_to_user', component: assign_permission_model },
    { path: '/users', name: 'users', component: users },
    { path: '/users/user_update', name: 'user_update', component: user_update },
    { path: '/users/password_reset', name: 'password_reset', component: password_reset },


    { path: '/buyer_manage', name: 'buyer_manage', component: buyer_manage },
    { path: '/buyer_manage/buyer_create', name: 'buyer_create', component: buyer_create },
    { path: '/buyer_edit', name: 'buyer_edit', component: buyer_edit },

    { path: '/seller_manage', name: 'seller_manage', component: seller_manage },
    { path: '/seller_manage/seller_create', name: 'seller_create', component: seller_create },
    { path: '/seller_edit', name: 'seller_edit', component: seller_edit },

    { path: '/connect_seller_buyer', name: 'connect_seller_buyer', component: connect_seller_buyer },

    { path: '/data_count', name: 'data_count', component: data_count },
    { path: '/memo_page', name: 'memo_page', component: memo_page },
    // { path: '/login', name: 'login', component: login_body },
];
