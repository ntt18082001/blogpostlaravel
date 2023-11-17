<template>
    <router-link :to="{ name: 'profile' }" class="btn btn-primary">
        Trở về
    </router-link>
    <div class="row mt-3">
        <div class="col-12">
            <div class="row" v-if="posts.value">
                <post-list :posts="posts.value" :is-edit="true"/>
            </div><!-- end row -->
        </div><!-- end col -->
    </div><!-- end row -->
    <Bootstrap5Pagination v-if="posts.value"
                          :data="posts.value"
                          @pagination-change-page="getAllMyPost"
    />
</template>

<script>
import {ref} from "vue";
import PostList from "./PostList.vue";
import {Bootstrap5Pagination} from "laravel-vue-pagination";

export default {
    name: 'AllMyPost',
    components: {PostList, Bootstrap5Pagination},
    setup() {
        const posts = ref({});
        return {
            posts,
        }
    },
    methods: {
        async getAllMyPost(page = 1) {
            await axios.get(`/api/get_all_my_post?page=${page}`)
                .then(res => {
                    this.posts.value = res.data.data;
                });
        }
    },
    async mounted() {
        await this.getAllMyPost();
    }
}
</script>
