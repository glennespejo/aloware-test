<template>
    <div>
        <input type="text" v-model="comment" class="form-control" v-on:keyup.enter="replyTo(comment)">
    </div>
</template>
<style>
</style>
<script>
    export default{
        props: ['comment'],
        data(){
            return{
                comment: ''
            }
        },
        methods:{
            replyTo (comment) {
                axios.post('/api/v1/comment/add', {content: this.content, post_id: comment.post_id, parent_id: comment.id}).then(response => {
                   this.comment = '';
                   this.$parent.getPost();
                });
            }
        }
    }
</script>
