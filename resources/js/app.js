require('./bootstrap');

import router from './routes.js';


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);



new Vue({
    el: '#app',
    router
});
