<script setup>
    import { onMounted, ref } from "vue";
    import { Bootstrap5Pagination } from "laravel-vue-pagination";
    import DateTimeFormat from "../DateTimeFormat.vue";

    let posts = ref({});

    onMounted(async () => {
        getPosts();
    });

    const getPosts = async (page = 1) => {
        let res = await axios.get(`/api/get_all_post?page=${page}`);
        posts.value = res.data.posts;
    };
</script>

<template>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-xxl-6" v-for="item in posts.data" :key="item.id">
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
                                        | <DateTimeFormat :time="item.created_at" /></small></p>
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
