<template>
    <div class="row">
        <div class="col-md-8" v-if="post.value">
            <h1>{{ post.value.title }}</h1>
            <p class="mt-3" v-if="post.value.author">Đăng bởi: {{ post.value.author.full_name }} | Ngày đăng:
                <DateTimeFormat :time="post.value.created_at"/>
            </p>
            <div class="content-blog" v-html="post.value.content">
            </div>
            <div class="mt-3">
                <FormComment :post_id="post.value.id" :add-comment="addComment"/>
                <div class="mt-3 comment-container">
                    <div class="d-flex gap-2 mt-2" v-for="item in comments.value.data"
                         v-if="comments.value.data && comments.value.data.length > 0">
                        <img class="rounded-circle header-profile-user"
                             :src="'/storage/avatar/' + item.author.avatar" alt="Header Avatar" v-if="item.author">
                        <img class="rounded-circle header-profile-user"
                             :src="'/assets/images/users/user-dummy-img.jpg'"
                             alt="Header Avatar" v-else>
                        <div class="w-100">
                            <p class="my-auto mx-0" v-if="item.author"><strong>{{ item.author.full_name }}: </strong>
                                <span>{{ item.content }}</span>
                            </p>
                            <button class="d-inline-block btn js-reply" @click="toggleReplyForm(item.id, post.value.id)">
                                Trả lời
                            </button>
                            <span><DateTimeFormat :time="item.created_at"/></span>
                            <div class="replyContainer"
                                 v-if="toggleReplyFormData.showReplyForm && toggleReplyFormData.selectedItem === item.id">
                                <form class="mt-3 form-reply"
                                      @submit.prevent="handlerReplyCommentSubmit(item.id, post.value.id)">
                                    <input type="hidden" name="post_id">
                                    <input type="hidden" name="parent_id">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="content"
                                               placeholder="abc..."
                                               required="required"
                                               ref="inputReplyCommentRef"
                                               aria-label="Recipient's username"
                                               aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary js-submit" type="submit"
                                                id="button-addon2">
                                            Gửi
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div :class="'replyCommentContainer' + item.id + post.value.id">
                                <div class="d-flex gap-2 mt-2" v-for="child in item.comment_childs"
                                     v-if="item.comment_childs && item.comment_childs.length > 0">
                                    <img class="rounded-circle header-profile-user"
                                         :src="'/storage/avatar/' + child.author.avatar"
                                         alt="Header Avatar" v-if="child.author">
                                    <img class="rounded-circle header-profile-user"
                                         :src="'/assets/images/users/user-dummy-img.jpg'"
                                         alt="Header Avatar" v-else>
                                    <div class="w-100">
                                        <p class="my-auto mx-0">
                                            <strong v-if="child.author">{{ child.author.full_name }}: </strong>
                                            <span>{{ child.content }}</span>
                                        </p>
                                        <span><DateTimeFormat :time="child.created_at"/></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-link js-load-more"
                                    @click="loadMoreComment(item.comment_childs[item.comment_childs.length-1].id, item.comment_childs[item.comment_childs.length-1].parent_id, post.value.id)"
                                    v-if="item.has_child === 1">
                                Xem thêm bình luận
                            </button>
                        </div>
                    </div>
                    <p v-else>Chưa có bình luận</p>
                    <div class="mt-3">
                        <Bootstrap5Pagination
                            :data="comments.value"
                            @pagination-change-page="getPost"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <RelatedPost :post_id="postId"/>
        </div>
    </div>
</template>

<script>
    import {ref} from "vue";
    import RelatedPost from './RelatedPost.vue';
    import DateTimeFormat from '../DateTimeFormat.vue';
    import FormComment from './FormComment.vue';
    import {useRoute} from "vue-router";
    import {Bootstrap5Pagination} from 'laravel-vue-pagination';

    export default {
        name: 'PostDetail',
        setup() {
            const route = useRoute();
            const post = ref({});
            const comments = ref({});
            const user = ref({});
            const postId = route.params.id;
            const inputReplyCommentRef = ref(null);
            const toggleReplyFormData = ref({
                showReplyForm: false,
                selectedItem: null,
            });
            return {
                post,
                comments,
                user,
                postId,
                inputReplyCommentRef,
                toggleReplyFormData
            }
        },
        components: {
            RelatedPost,
            DateTimeFormat,
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
            toggleReplyForm(parentId) {
                this.toggleReplyFormData.showReplyForm = true;
                this.toggleReplyFormData.selectedItem = parentId;
            },
            hideReplyForm() {
                this.toggleReplyFormData.showReplyForm = false;
                this.toggleReplyFormData.selectedItem = null;
            },
            addChildComment(comment) {
                const parentIndex = this.comments.value.data.findIndex(x => x.id === comment.parent_id);
                this.comments.value.data[parentIndex].comment_childs.unshift(comment);
            },
            async handlerReplyCommentSubmit(parentId, postId) {
                const inputReplyCommentValue = this.inputReplyCommentRef[0];
                await axios.post('/api/comment', { parent_id: parentId, post_id: postId, content: inputReplyCommentValue.value })
                    .then(res => {
                        inputReplyCommentValue.value = '';
                        this.addChildComment(res.data.comment);
                        this.hideReplyForm();
                    })
                    .catch(error => {
                        console.error("Error submit: " + error);
                    });
            },
            async loadMoreComment(lastCommentId, parentId, postId) {
                console.log(lastCommentId, parentId, postId);
                const data = await axios.get(`/api/get_more_comment/${lastCommentId}_${parentId}_${postId}`)
                    .then(function (response) {
                        return response.data.data;
                    });
                data.comments.reverse();
                const parentIndex = this.comments.value.data.findIndex(x => x.id === parentId);
                this.comments.value.data[parentIndex].comment_childs.push(...data.comments);
                this.comments.value.data[parentIndex].has_child = data.has_more;
                console.log(this.comments.value);
            }
        },
        async mounted() {
            await this.getPost();
        }
    }
</script>
