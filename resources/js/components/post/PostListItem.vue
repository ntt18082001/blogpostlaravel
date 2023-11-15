<template>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                <router-link :to="{ name: 'post-detail', params: { id: post.id }}">
                    <img class="rounded-start img-fluid h-100 object-cover img-thumb"
                         :src="'/storage/post/' + post.cover_path" alt="Card image">
                </router-link>
            </div>
            <div class="col-md-8">
                <div class="card-header">
                    <router-link :to="{ name: 'post-detail', params: { id: post.id }}">
                        <h5 class="card-title mb-0">{{ post.title }}</h5>
                    </router-link>
                </div>
                <div class="card-body">
                    <p class="card-text mb-2 hidden-text">{{ post.summary }}</p>
                    <p class="card-text text-author"><small
                        class="text-muted">{{ post.author.full_name }}
                        | {{ formattedTime(post.created_at) }}</small></p>
                </div>
            </div>
        </div>
    </div><!-- end card -->
</template>

<script>
import {formatDateTimeMixin} from "../../helpers/index.js";

export default {
    name: 'PostListItem',
    mixins: [formatDateTimeMixin],
    props: {
        post: {
            type: Object
        }
    }
}
</script>
