<template>
    <div class="pt-3 font-size-sm">
        <div  v-for="comment in comments" :key="comment.id" class="media">
            <a class="img-link mr-2" href="javascript:void(0)">
                <img class="img-avatar img-avatar32 img-avatar-thumb" src="themes/dashmix/assets/media/avatars/avatar.jpg" alt="">
            </a>
            <div class="media-body">
                <p class="mb-1">
                    <a class="font-w600" href="javascript:void(0)">{{ comment.user.name }}</a>
                    {{ comment.comment }}
                </p>
                <p>
                    <a href="javascript:void(0)" @click="replyToComment = comment">Reply</a>
                </p>
                <comment-list v-if="collection[comment.id]" v-bind:comments="collection[comment.id]" v-bind:collection="collection"></comment-list>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['collection','comments'],
        computed:{
        },
        beforeCreate: function () {
            this.$options.components.CommentList = require('./CommentList.vue');
        }
    }
</script>
