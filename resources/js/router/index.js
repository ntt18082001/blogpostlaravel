import {createRouter, createWebHistory} from "vue-router";

import Index from '../components/post/index.vue';

import PostDetail from '../components/post/detail.vue';

import ProfileIndex from '../components/profile/Index.vue';

import CreatePost from "../components/post/CreatePost.vue";

import EditPost from "../components/post/EditPost.vue";

import AllMyPost from "../components/post/AllMyPost.vue";

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
        path: '/post/create',
        component: CreatePost,
        name: 'post-create'
    },
    {
        path: '/post/edit/:id',
        component: EditPost,
        name: 'post-edit'
    },
    {
        path: '/post/allMyPost',
        component: AllMyPost,
        name: 'all-my-post'
    },
    {
        path: '/profile',
        component: ProfileIndex,
        name: 'profile'
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
