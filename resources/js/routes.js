import VueRouter from 'vue-router';

let routes = [
    {
        path: '/albums',
        component: require('./views/Albums.vue').default
    },
    {
        path: '/artists',
        component: require('./views/Artists.vue').default
    }
];

export default new VueRouter({
    routes
});