import VueRouter from 'vue-router';

let routes = [
    {
        path: '/albums',
        component: require('./views/Albums.vue').default
    },
    {
        path: '/artists',
        component: require('./views/Artists.vue').default
    },
    {
        path: '/listens',
        component: require('./views/Listens.vue').default
    }
];

export default new VueRouter({
    routes
});