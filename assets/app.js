import {registerVueControllerComponents} from '@symfony/ux-vue';
import './bootstrap.js';
import VueSmoothScroll from 'vue3-smooth-scroll'
import './styles/app.scss';

document.addEventListener('vue:before-mount', (event) => {
    const {
        componentName, // The Vue component's name
        component, // The resolved Vue component
        props, // The props that will be injected to the component
        app, // The Vue application instance
    } = event.detail;

    // Example with Vue Router

    app.use(VueSmoothScroll);
});

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));