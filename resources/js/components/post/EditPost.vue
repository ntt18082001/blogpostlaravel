<template>
    <form enctype="multipart/form-data" @submit.prevent="handleSubmit" v-if="post.value">
        <h2 class="mb-3">Sửa bài viết</h2>
        <div class="mb-3">
            <label for="title" class="form-label required">Tiêu đề</label>
            <input type="text" class="form-control" name="title" id="title" required :value="post.value.title">
        </div>
        <div class="form-group group-container mb-3 mt-3">
            <label class="control-label required">Ảnh bìa</label>
            <input name="cover_path" id="img_path" type="file" ref="fileRef" @change="handleFileChange" class="form-control fake-d-none" accept="image/*">
            <div class="position-relative">
                <input type="button"  @click="handleChooseFile" class="btn btn-choose-file w-100 h-100 position-absolute">
                <div class="selectedImages w-100 height-img-cover">
                    <img v-if="selectedFileUrl" class="image-review" :src="selectedFileUrl"/>
                    <img v-else class="image-review" :src="'/storage/post/' + post.value.cover_path" />
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label required">Tóm tắt</label>
            <textarea class="form-control" id="summary" name="summary" required rows="3">{{post.value.summary}}</textarea>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 required">Nội dung</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <QuillEditor :options="quillOptions" v-model:content="content" :style="{ height: '400px' }" content-type="html" />
            </div><!-- end card-body -->
        </div><!-- end card -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="category_id" class="form-label required">Thể loại</label>
                <select class="form-select" name="category_id" id="category_id" required>
                    <option value="">Chọn thể loại</option>
                    <option v-for="cate in categories" :value="cate.id" :selected="cate.id === post.value.category_id">
                        {{cate.cate_name}}
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success me-2"><i class="fa fa-save"></i>Lưu</button>
            <router-link :to="{ name: 'all-my-post' }" class="btn btn-secondary"><i class="fa fa-save"></i>Trở về</router-link>
        </div>
    </form>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {ref} from "vue";
import {QuillEditor} from "@vueup/vue-quill";
import {toast} from "vue3-toastify";

export default {
    name: 'EditPost',
    data() {
        const post = ref({});
        const postId = '';
        return {
            quillOptions: {
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{'header': 1}, {'header': 2}],
                        [{'list': 'ordered'}, {'list': 'bullet'}],
                        [{'script': 'sub'}, {'script': 'super'}],
                        [{'indent': '-1'}, {'indent': '+1'}],
                        [{'direction': 'rtl'}],
                        [{'size': ['small', false, 'large', 'huge']}],
                        [{'header': [1, 2, 3, 4, 5, 6, false]}],
                        ['link', 'image', 'video', 'formula'],
                        [{'color': []}, {'background': []}],
                        [{'font': []}],
                        [{'align': []}],
                        ['clean']
                    ]
                },
                theme: 'snow',  // You can change the theme if needed
            },
            postId,
            post,
            content: '',
            fileInput: null,
            selectedFileUrl: null,
            categories: [],
        }
    },
    setup() {
        const router = useRouter();

        return {
            router,
        }
    },
    components: {
        QuillEditor
    },
    created() {
        const route = useRoute();
        this.postId = route.params.id;
    },
    methods: {
        async getCategory() {
            await axios.get('/api/get_all_category')
                .then(res => {
                    this.categories = res.data;
                });
        },
        async getPost() {
            let res = await axios.get(`/api/get_post_edit/${this.postId}`);
            this.post.value = res.data.post;
            this.content = res.data.post.content;
        },
        handleChooseFile() {
            this.$refs.fileRef.click();
        },
        handleFileChange(event) {
            const [file] = event.target.files;
            if (file) {
                this.fileInput = file;
                this.selectedFileUrl = URL.createObjectURL(file);
            }
        },
        async handleSubmit() {
            if(!this.content || this.content === '<p><br></p>') {
                toast.warning("Bạn chưa thêm nội dung!",{
                    position: toast.POSITION.BOTTOM_RIGHT
                });
                return;
            }

            const data = new FormData(this.$el);
            data.append('content', this.content);
            await axios.post(`/api/save_post/${this.postId}`, data)
                .then(res => {
                    if(res.data.successMsg) {
                        toast.success(res.successMsg,{
                            position: toast.POSITION.BOTTOM_RIGHT
                        });
                        this.router.push({ name: 'all-my-post' })
                        return;
                    }
                    if(res.data.errorMsg) {
                        toast.error(res.errorMsg,{
                            position: toast.POSITION.BOTTOM_RIGHT
                        });
                    }
                })
                .catch(err => {
                    toast.error(err.message, {
                        position: toast.POSITION.BOTTOM_RIGHT
                    });
                });
        }
    },
    async mounted() {
        await this.getPost();
        await this.getCategory();
    }
}
</script>
