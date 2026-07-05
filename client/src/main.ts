import { createApp } from 'vue'
import { createPinia } from 'pinia';

import router from './router/index.ts';

// import view
import App from './App.vue'

// import style
import './style.css'

const pinia = createPinia()
const app = createApp(App)

app.use(router)
app.use(pinia)
app.mount('#app')