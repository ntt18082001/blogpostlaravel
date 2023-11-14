<script setup>
    import { onMounted, ref } from "vue";

    const props = defineProps(['post_id']);

    const relatedPosts = ref({});

    onMounted(async () => {
        await getRelatedPost();
    });

    const getRelatedPost = async () => {
        const res = await axios.get(`/api/get_related_post/${props.post_id}`);
        relatedPosts.value = res.data;
    }
</script>

<template>
    <div class="row">
        <h4>Bài viết liên quan</h4>
        <div class="col-md-12 col-sm-6" v-for="item in relatedPosts.data">
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
