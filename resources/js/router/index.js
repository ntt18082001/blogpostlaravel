import {createRouter, createWebHistory} from "vue-router";

import Index from '../components/post/index.vue';

import PostDetail from '../components/post/detail.vue';

import NotFound from "../components/NotFound.vue";

const routes = [
    {
        path: '/vue',
        component: Index,
        name: 'index'
    },
    {
        path: '/post/:id',
        component: PostDetail,
        name: 'post-detail'
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
