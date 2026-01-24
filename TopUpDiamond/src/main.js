import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import routes from '@/routes/routes.js'

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

import ToastService from 'primevue/toastservice';


import '/node_modules/primeflex/primeflex.css'

import i18n from './i18n'
import 'primeicons/primeicons.css'

// import component
import Header from '@/layouts/Header.vue'
import Footer from '@/layouts/Footer.vue'
import Chip from 'primevue/chip';
import Card from 'primevue/card';
import Toolbar from 'primevue/toolbar';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
// import Dialog from 'primevue/dialog';


const app = createApp(App)
app.use(routes)

app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

app.use(ToastService);
app.component('Header', Header);
app.component('Footer', Footer);
app.component('Chip', Chip);
app.component('Card', Card);
app.component('Toolbar', Toolbar);
app.component('Avatar', Avatar);
app.component('InputText', InputText);
app.component('Button', Button);
// app.component('Dialog', Dialog);


app.use(i18n);
window.t = (key) => i18n.global.t(key)

app.mount('#app')
