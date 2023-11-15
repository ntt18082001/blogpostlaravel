<template>
    <div class="col-xxl-6" v-for="item in posts.data" :key="item.id">
        <post-list-item :post="item" />
    </div><!-- end col -->
</template>

<script>
import PostListItem from "./PostListItem.vue";

export default {
    name: 'PostList',
    components: {PostListItem},
    props: {
        posts: {
            type: Object
        }
    }
}
</script>
