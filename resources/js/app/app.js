import "../bootstrap";
import "bootstrap/dist/js/bootstrap.bundle";

import FlashMessage from "./components/FlashMessage.vue";
import Comment from "./components/Comment.vue";
import ImageGalery from "./components/ImageGalery.vue";
import ImageSlider from "./components/ImageSlider.vue";

const app = new Vue({
    el: "#app",
    components: {
        FlashMessage,
        Comment,
        ImageGalery,
        ImageSlider
    }
});
