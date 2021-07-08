<template>
    <div>
        <BlockUI v-show="loader" :message="msg" :html="html"></BlockUI>
        <div v-for="post in posts" :key="post.id">
            <article class="js-gallery story">
                <h3>{{post.title}}</h3>
                <p>{{post.body}}</p>
            </article>
            <div class="px-4 pt-4 rounded bg-white">
                <form action="be_pages_blog_story.html" method="POST" onsubmit="return false;">
                    <input type="text" class="form-control form-control-alt"  v-model="newComment" v-on:keyup.enter="addNewComment(post)" placeholder="Write a comment..">
                </form>
                <div class="pt-3 font-size-sm">
                    <comment-list v-if="post.comments" :collection="post.comments" :comments="post.comments.root"></comment-list>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import BlockUI from 'vue-blockui'
    import VueNoty from 'vuejs-noty'
    import 'vuejs-noty/dist/vuejs-noty.css'
    import CommentList from './CommentList.vue';

    Vue.use(BlockUI);
    Vue.use(VueNoty)

    export default {
        components: {
			'comment-list': CommentList
		},
        data: function() {
            return {
                loader: false,
                msg: 'Loading...',
                html: '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>',
                posts: [],
                newComment: ''
            }
        },
        mounted() {
            var __this = this;
            __this.getPost();
        },
        methods: {
            getPost () {
                var __this = this;
                __this.loader = true;
                axios.get('/api/v1/posts')
                .then(function (response) {
                    __this.posts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    __this.loader = false
                });
            },
            addNewComment :function (post) {
                var __this = this;
                __this.loader = true;
				axios.post('/api/v1/comment/add', {comment: this.newComment, post_id: post.id}).then(response => {
					__this.newComment = ''
				});
			}
        }
    }
</script>
