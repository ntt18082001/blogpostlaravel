<template>
    <div class="mt-2" v-for="item in comments.data"
         v-if="comments.data && comments.data.length > 0">
        <div class="d-flex gap-2">
            <comment-list-item :comment="item" :post-id="postId" :is-reply="true" :add-child-comment="addChildComment" />
        </div>
        <div :class="'replyCommentContainer' + item.id + postId" class="ms-5">
            <div class="d-flex gap-2 mt-2" v-for="child in item.comment_childs"
                 v-if="item.comment_childs && item.comment_childs.length > 0">
                <comment-list-item :comment="child" :post-id="postId" :is-reply="false" :add-child-comment="addChildComment" />
            </div>
        </div>
        <button class="btn btn-link js-load-more"
                @click="loadMoreComment(item.comment_childs[item.comment_childs.length-1].id, item.comment_childs[item.comment_childs.length-1].parent_id, postId)"
                v-if="item.has_child === 1">
            Xem thêm bình luận
        </button>
    </div>
    <p v-else>Chưa có bình luận</p>
</template>

<script>
import {ref} from "vue";
import {formatDateTimeMixin} from "../../helpers/index.js";
import CommentListItem from "./CommentListItem.vue";

export default {
    name: 'CommentList',
    components: {CommentListItem},
    mixins: [formatDateTimeMixin],
    props: {
        comments: {
            type: Object
        },
        postId: {
            type: Number
        }
    },
    methods: {
        addChildComment(comment) {
            const parentIndex = this.comments.data.findIndex(x => x.id === comment.parent_id);
            this.comments.data[parentIndex].comment_childs.unshift(comment);
        },
        async loadMoreComment(lastCommentId, parentId, postId) {
            console.log(lastCommentId, parentId, postId);
            const data = await axios.get(`/api/get_more_comment/${lastCommentId}_${parentId}_${postId}`)
                .then(function (response) {
                    return response.data.data;
                });
            const parentIndex = this.comments.data.findIndex(x => x.id === parentId);
            this.comments.data[parentIndex].comment_childs.push(...data.comments);
            this.comments.data[parentIndex].has_child = data.has_more;
        }
    }
}
</script>
