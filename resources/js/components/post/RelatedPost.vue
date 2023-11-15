<template>
    <div class="row">
        <h4>Bài viết liên quan</h4>
        <div class="col-md-12 col-sm-6" v-for="item in relatedPosts.value">
            <div class="card" style="width: 18rem;">
                <router-link :to="{ name: 'post-detail', params: { id: item.id }}">
                    <img :src="'/storage/post/' + item.cover_path" class="card-img-top" alt="...">
                </router-link>
                <div class="card-body">
                    <router-link :to="{ name: 'post-detail', params: { id: item.id }}">
                        <h5 class="card-title">{{ item.title }}</h5>
                    </router-link>
                    <p class="card-text hidden-text">{{ item.summary }}</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {ref} from "vue";
import {useRoute} from "vue-router";

export default {
    name: 'RelatedPost',
    props: {
        postId: {
            type: String
        }
    },
    setup() {
        const relatedPosts = ref({});
        return {
            relatedPosts
        }
    },
    created() {
        this.$watch(
            () => this.postId,
            async () => {
                await this.getRelatedPost();
            }
        )
    },
    methods: {
        async getRelatedPost() {
            const res = await axios.get(`/api/get_related_post/${this.postId}`);
            this.relatedPosts.value = res.data.data;
        }
    },
    async mounted() {
        await this.getRelatedPost();
    }
}
</script>
