<template>
    <div class="row">
        <div class="col-12">
            <div class="row" v-if="posts.value">
                <post-list :posts="posts.value" />
            </div><!-- end row -->
        </div><!-- end col -->
    </div><!-- end row -->
    <Bootstrap5Pagination v-if="posts.value"
        :data="posts.value"
        @pagination-change-page="getPosts"
    />
</template>

<script>
import {ref} from "vue";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
import {formatDateTimeMixin} from "../../helpers/index.js";
import PostList from "./PostList.vue";

export default {
    setup() {
        let posts = ref({});

        return {
            posts
        }
    },
    mixins: [formatDateTimeMixin],
    components: {
        PostList,
        Bootstrap5Pagination
    },
    methods: {
        async getPosts(page = 1) {
            let res = await axios.get(`/api/get_all_post?page=${page}`);
            this.posts.value = res.data.posts;
        }
    },
    async mounted() {
        await this.getPosts();
    }
}
</script>
