import { createApp } from 'vue'
import User from './components/User.vue';

const app = createApp({});
app.component('user-form', User)
    .mount('#app');

require('./bootstrap');
