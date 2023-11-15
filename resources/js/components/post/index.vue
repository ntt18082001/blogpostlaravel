<template>
    <div class="row">
        <div class="col-12">
            <div class="row" v-if="posts.value">
                <div class="col-xxl-6" v-for="item in posts.value.data" :key="item.id">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <router-link :to="{ name: 'post-detail', params: { id: item.id }}">
                                    <img class="rounded-start img-fluid h-100 object-cover img-thumb"
                                         :src="'/storage/post/' + item.cover_path" alt="Card image">
                                </router-link>
                            </div>
                            <div class="col-md-8">
                                <div class="card-header">
                                    <router-link :to="{ name: 'post-detail', params: { id: item.id }}">
                                        <h5 class="card-title mb-0">{{ item.title }}</h5>
                                    </router-link>
                                </div>
                                <div class="card-body">
                                    <p class="card-text mb-2 hidden-text">{{ item.summary }}</p>
                                    <p class="card-text text-author"><small
                                        class="text-muted">{{ item.author.full_name }}
                                        | {{ formattedTime(item.created_at) }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end col -->
    </div><!-- end row -->
    <Bootstrap5Pagination
        :data="posts"
        @pagination-change-page="getPosts"
    />
</template>

<script>
import {ref} from "vue";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
import {formatDateTimeMixin} from "../../helpers/index.js";

export default {
    setup() {
        let posts = ref({});

        return {
            posts
        }
    },
    mixins: [formatDateTimeMixin],
    components: {
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
