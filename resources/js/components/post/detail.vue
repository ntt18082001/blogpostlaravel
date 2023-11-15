<template>
    <div class="row">
        <div class="col-md-8" v-if="post.value">
            <router-link :to="{ name: 'index' }" class="btn btn-primary">
                Trở về
            </router-link>
            <h1 class="mt-2">{{ post.value.title }}</h1>
            <p class="mt-3" v-if="post.value.author">Đăng bởi: {{ post.value.author.full_name }} | Ngày đăng:
                {{ formattedTime(post.value.created_at) }}
            </p>
            <div class="content-blog" v-html="post.value.content"></div>
            <router-link :to="{ name: 'index' }" class="btn btn-primary">
                Trở về
            </router-link>
            <div class="mt-3">
                <FormComment :post_id="post.value.id" :add-comment="addComment"/>
                <div class="mt-3 comment-container">
                    <comment-list :comments="comments.value" :post-id="post.value.id" />
                    <div class="mt-3">
                        <Bootstrap5Pagination
                            :data="comments.value"
                            @pagination-change-page="getPost"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <RelatedPost :post-id="postId"/>
        </div>
    </div>
</template>

<script>
    import {ref} from "vue";
    import RelatedPost from './RelatedPost.vue';
    import FormComment from './FormComment.vue';
    import {useRoute} from "vue-router";
    import {Bootstrap5Pagination} from 'laravel-vue-pagination';
    import {formatDateTimeMixin} from "../../helpers/index.js";
    import CommentList from "./CommentList.vue";

    export default {
        name: 'PostDetail',
        setup() {
            const post = ref({});
            const comments = ref({});
            const user = ref({});
            const postId = '';
            return {
                post,
                comments,
                user,
                postId,
            }
        },
        created() {
            const route = useRoute();
            this.postId = route.params.id;
            this.$watch(
                () => route.params,
                async () => {
                    this.postId = route.params.id;
                    await this.getPost();
                }
            )
        },
        mixins: [formatDateTimeMixin],
        components: {
            CommentList,
            RelatedPost,
            FormComment,
            Bootstrap5Pagination
        },
        methods: {
            async getPost(page = 1) {
                let res = await axios.get(`/api/get_detail_post/${this.postId}?page=${page}`);
                this.post.value = res.data.post;
                this.comments.value = res.data.comments;
            },
            addComment(comment) {
                this.comments.value.data.unshift(comment);
            },
        },
        async mounted() {
            await this.getPost();
        },
    }
</script>
