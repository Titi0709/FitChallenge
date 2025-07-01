import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import vuetify from './vuetify';
import AppLayout from './Layouts/AppLayout.vue';

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue');
    const page = (await pages[`./Pages/${name}.vue`]()).default;


    if (!['Login', 'Register'].includes(name)) {
      page.layout = AppLayout;
    }

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(vuetify)
      .mount(el);
  },
});













