require('./bootstrap');
require('./buefy');

import BottonComponent from "./components/BottonComponent";
import DisableComponent from "./components/DisableComponent";

const app = new Vue({
    el: '#app',
    components: {
        BottonComponent,
        DisableComponent
     },
});
