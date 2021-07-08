import Vue from 'vue'
import Post from './components/Post.vue';
const app = new Vue({
    el: '#app',
    components: {
        'post' :  Post
    }
});
