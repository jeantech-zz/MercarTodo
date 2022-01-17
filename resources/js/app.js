require('./bootstrap');
require('./buefy');

import BottonComponent from "./components/BottonComponent";
import AddComponent from "./components/AddComponent";

const app = new Vue({
    el: '#app',
    components: {
        BottonComponent,
        AddComponent
     },
});
