<template>
    <div class="pt-3 font-size-sm">
        <comment v-for="comment in comments" v-bind:comment="comment" :key="comment.id" v-bind:collection="collection"></comment>
    </div>
</template>
<script>
    export default{
        props: ['collection','comments'],
        computed:{
        },
        beforeCreate: function () {
            this.$options.components.Comment = require('./Comment.vue');
        }
    }
</script>
