import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import "@tabler/core/dist/js/tabler.min.js"
import "@tabler/core/dist/js/demo.min.js"
import Layout from "./Shared/Layout";
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue';
import { Ziggy } from '../../vendor/tightenco/ziggy';
import VueApexCharts from "vue3-apexcharts";

InertiaProgress.init({
    color: "blue",
    showSpinner: true,
});

createInertiaApp({
    resolve: (name) => {
        let page = require(`./Pages/${name}`).default;

        if (page.layout === undefined) {
            page.layout = Layout;
        }

        return page;
    },

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueApexCharts)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },

    title: (title) => `Jafung - ${title}`,
});
