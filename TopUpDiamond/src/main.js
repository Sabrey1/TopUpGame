import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import routes from '@/routes/routes.js'

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

import '/node_modules/primeflex/primeflex.css'

import i18n from './i18n'
import 'primeicons/primeicons.css'

const app = createApp(App)
app.use(routes)

app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});
app.use(i18n);
window.t = (key) => i18n.global.t(key)

app.mount('#app')
