<template>
    <router-link :to="{ name: 'index' }" class="btn btn-primary">
        Trở về
    </router-link>
    <form-profile :profile="userInfo.value" :set-user-info="setUserInfo" />
    <a href="#" class="btn btn-primary mb-3 me-3">
        <i class="mdi mdi-account-plus"></i>
        Thêm bài viết
    </a>
    <div class="row">
        <div class="col-md-6">
            <a href="#">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">My Blogs</p>
                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                                                data-target="{{countPost}}">{{countPost}}</span>
                                    posts</h2>
                                <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                                                <i class="ri-arrow-down-line align-middle"></i> 50.5 %
                                                            </span> vs. previous month</p>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-secondary rounded-circle fs-2">
                                                                <i data-feather="layout"></i>
                                                            </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div> <!-- end card-->
            </a>
        </div> <!-- end col-->
    </div>
</template>

<script>
import {ref} from "vue";
import FormProfile from "./FormProfile.vue";

export default {
    name: 'ProfileIndex',
    components: {FormProfile},
    setup() {
        const userInfo = ref({});
        const countPost = ref(0);
        return {
            userInfo,
            countPost,
        }
    },
    methods: {
        async getUserProfile() {
            await axios.get('/api/user')
                .then(res => {
                    this.userInfo.value = res.data;
                });
        },
        async getCountMyPost() {
            await axios.get('/api/profile/count_my_post')
                .then(res => {
                    this.countPost = res.data;
                });
        },
        setUserInfo(userInfo) {
            this.userInfo.value = userInfo;
            this.userInfo.value.gender = Number(this.userInfo.value.gender);
        }
    },
    async mounted() {
        await this.getUserProfile();
        await this.getCountMyPost();
    }
}
</script>
