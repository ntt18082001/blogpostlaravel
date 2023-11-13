import {createRouter, createWebHistory} from "vue-router";

import Test from '../components/test/index.vue';

import PostDetail from '../components/test/detail.vue';

import NotFound from "../components/NotFound.vue";

const routes = [
    {
        path: '/test-vue',
        component: Test
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
