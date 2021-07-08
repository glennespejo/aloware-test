<template>
    <div class="media">
        <a class="img-link mr-2" href="javascript:void(0)">
            <img class="img-avatar img-avatar32 img-avatar-thumb" src="themes/dashmix/assets/media/avatars/avatar.jpg" alt="">
        </a>
        <div class="media-body">
            <p class="mb-1">
                <a class="font-w600" href="javascript:void(0)">{{ comment.user.name }}</a>
                {{ comment.comment }}
            </p>
            <p>
                <a @click="replyToComment = comment">Reply</a>
            </p>
            <comment-form v-if="replyToComment == comment" :comment="comment"></comment-form>
            <comment-list v-if="collection[comment.id]" v-bind:comments="collection[comment.id]" v-bind:collection="collection"></comment-list>
        </div>
    </div>
</template>
<script>
    import CommentList from './CommentList.vue';
    import CommentForm from './CommentForm.vue';
    export default{
        props: ['comment', 'collection'],
        data(){
            return {
                replyToComment: false
            }
        },
        mounted(){
        },
        components: {
            'comment-list': CommentList,
            'comment-form': CommentForm,
        }
    }
</script>
