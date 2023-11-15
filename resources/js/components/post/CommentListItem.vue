<template>
    <img class="rounded-circle header-profile-user"
         :src="'/storage/avatar/' + comment.author.avatar" alt="Header Avatar" v-if="comment.author">
    <img class="rounded-circle header-profile-user"
         :src="'/assets/images/users/user-dummy-img.jpg'"
         alt="Header Avatar" v-else>
    <div class="w-100">
        <p class="my-auto mx-0" v-if="comment.author"><strong>{{ comment.author.full_name }}: </strong>
            <span>{{ comment.content }}</span>
        </p>
        <button class="d-inline-block btn js-reply" @click="toggleReplyForm(comment.id, postId)" v-if="isReply">
            Trả lời
        </button>
        <span>{{ formattedTime(comment.created_at) }}</span>
        <div class="replyContainer"
             v-if="toggleReplyFormData.showReplyForm && toggleReplyFormData.selectedItem === comment.id">
            <form class="mt-3 form-reply"
                  @submit.prevent="handlerReplyCommentSubmit(comment.id, postId)">
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
    </div>
</template>

<script>
import {formatDateTimeMixin} from "../../helpers/index.js";
import {ref} from "vue";

export default {
    props: {
        comment: {
            type: Object
        },
        isReply: {
            type: Boolean
        },
        postId: {
            type: Number
        },
        addChildComment: {
            type: Function
        }
    },
    setup() {
        const inputReplyCommentRef = ref(null);
        const toggleReplyFormData = ref({
            showReplyForm: false,
            selectedItem: null,
        });
        return {
            toggleReplyFormData,
            inputReplyCommentRef
        }
    },
    mixins: [formatDateTimeMixin],
    methods: {
        toggleReplyForm(parentId) {
            this.toggleReplyFormData.showReplyForm = true;
            this.toggleReplyFormData.selectedItem = parentId;
        },
        hideReplyForm() {
            this.toggleReplyFormData.showReplyForm = false;
            this.toggleReplyFormData.selectedItem = null;
        },
        async handlerReplyCommentSubmit(parentId, postId) {
            await axios.post('/api/comment', {
                parent_id: parentId,
                post_id: postId,
                content: this.inputReplyCommentRef.value
            })
                .then(res => {
                    this.inputReplyCommentRef.value = '';
                    this.addChildComment(res.data.comment);
                    this.hideReplyForm();
                })
                .catch(error => {
                    console.error("Error submit: " + error);
                });
        },
    }
}
</script>
