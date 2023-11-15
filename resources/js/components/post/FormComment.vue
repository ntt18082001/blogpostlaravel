<script setup>
    import { ref } from "vue";

    const props = defineProps(['post_id', 'addComment']);
    const addComment = props.addComment;
    const inputRef = ref(null);

    const submitCommentHandler = async () => {
        const inputComment = inputRef.value;
        if (props.post_id) {
            await axios.post('/api/comment', { post_id: props.post_id, content: inputComment.value })
                .then(res => {
                    inputRef.value.value = '';
                    inputRef.value.focus();

                    addComment(res.data.comment);
                })
                .catch(error => {
                    console.error("Error submit: " + error);
                });
        }
    }
</script>

<template>
    <h4>Bình luận</h4>
    <form class="mt-3 form-comment" @submit.prevent="submitCommentHandler">
        <input type="hidden" name="post_id" :value="props.post_id">
        <div class="input-group mb-3">
            <input type="text" class="form-control" ref="inputRef" required name="content" placeholder="abcd..."
                   aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary js-submit" type="submit" id="button-addon2">
                Gửi
            </button>
        </div>
    </form>
</template>
