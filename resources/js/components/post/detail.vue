<template>
    <div class="row">
        <div class="col-md-8">
            <h1>{{ post.title }}</h1>
            <p class="mt-3" v-if="post.author">Đăng bởi: {{ post.author.full_name }} | Ngày đăng:
                <DateTimeFormat :time="post.created_at"/>
            </p>
            <div class="content-blog" v-html="post.content">
            </div>
            <div class="mt-3">
                <FormComment :post_id="post.id" :add-comment="addComment"/>
                <div class="mt-3 comment-container">
                    <div class="d-flex gap-2 mt-2" v-for="item in comments.data"
                         v-if="comments.data && comments.data.length > 0">
                        <img class="rounded-circle header-profile-user"
                             :src="'/storage/avatar/' + item.author.avatar" alt="Header Avatar" v-if="item.author">
                        <img class="rounded-circle header-profile-user"
                             :src="'/assets/images/users/user-dummy-img.jpg'"
                             alt="Header Avatar" v-else>
                        <div class="w-100">
                            <p class="my-auto mx-0" v-if="item.author"><strong>{{ item.author.full_name }}: </strong>
                                <span>{{ item.content }}</span>
                            </p>
                            <button class="d-inline-block btn js-reply" @click="toggleReplyForm(item.id, post.id)">
                                Trả lời
                            </button>
                            <span><DateTimeFormat :time="item.created_at"/></span>
                            <div class="replyContainer"
                                 v-if="toggleReplyForData.showReplyForm && toggleReplyForData.selectedItem === item.id">
                                <form class="mt-3 form-reply"
                                      @submit.prevent="handlerReplyCommentSubmit(item.id, post.id)">
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
                            <div :class="'replyCommentContainer' + item.id + post.id">
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
                                    :data-last-comment-id="item.comment_childs[item.comment_childs.length-1].id"
                                    :data-post-id="post.id"
                                    :data-parent-id="item.comment_childs[item.comment_childs.length-1].parent_id"
                                    v-if="item.has_child === 1">
                                Xem thêm bình luận
                            </button>
                        </div>
                    </div>
                    <p v-else>Chưa có bình luận</p>
                    <div class="mt-3">
                        <Bootstrap5Pagination
                            :data="comments"
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

<script setup>
import {computed, onMounted, ref, watch} from "vue";
import {useRoute} from "vue-router";
import DateTimeFormat from "../DateTimeFormat.vue";
import FormComment from './FormComment.vue';
import {Bootstrap5Pagination} from "laravel-vue-pagination";
import RelatedPost from "./RelatedPost.vue";

let post = ref({});
let comments = ref({});
let user = ref({});
const route = useRoute();
const postId = ref(route.params.id);
const inputReplyCommentRef = ref(null);

let toggleReplyForData = ref({
    showReplyForm: false,
    selectedItem: null,
});

watch(postId, async (newPostId, oldPostId) => {
    await getPost();
});

onMounted(async () => {
    await getPost();
});

const getPost = async (page = 1) => {
    let res = await axios.get(`/api/get_detail_post/${postId.value}?page=${page}`);
    post.value = res.data.post;
    comments.value = res.data.comments;
};

const addComment = (comment) => {
    comments.value.data.unshift(comment);
}

const toggleReplyForm = (parentId) => {
    toggleReplyForData.value = {
        showReplyForm: true,
        selectedItem: parentId
    };
}

const hideReplyForm = () => {
    toggleReplyForData.value = {
        showReplyForm: false,
        selectedItem: null
    };
}

const addChildComment = (comment) => {
    const parentIndex = comments.value.data.findIndex(x => x.id === comment.parent_id);
    comments.value.data[parentIndex].comment_childs.unshift(comment);
}

const handlerReplyCommentSubmit = async (parentId, postId) => {
    const inputReplyCommentValue = inputReplyCommentRef.value[0];
    await axios.post('/api/comment', { parent_id: parentId, post_id: postId, content: inputReplyCommentValue.value })
        .then(res => {
            inputReplyCommentValue.value = '';
            addChildComment(res.data.comment);
            hideReplyForm();
        })
        .catch(error => {
            console.error("Error submit: " + error);
        });
}
</script>
