<template>
    <form enctype="multipart/form-data" @submit.prevent="handleSubmit">
        <h2 class="mb-3">Thêm bài viết</h2>
        <div class="mb-3">
            <label for="title" class="form-label required">Tiêu đề</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="form-group group-container mb-3 mt-3">
            <label class="control-label required">Ảnh bìa</label>
            <input name="cover_path" id="img_path" type="file" ref="fileRef" @change="handleFileChange" class="form-control fake-d-none" accept="image/*">
            <div class="position-relative">
                <input type="button"  @click="handleChooseFile" class="btn btn-choose-file w-100 h-100 position-absolute">
                <div class="selectedImages w-100 height-img-cover">
                    <img v-if="selectedFileUrl" class="image-review" :src="selectedFileUrl"/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label required">Tóm tắt</label>
            <textarea class="form-control" id="summary" name="summary" required rows="3"></textarea>
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
                    <option v-for="cate in categories" :value="cate.id">{{cate.cate_name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success me-2"><i class="fa fa-save"></i>Lưu</button>
            <router-link :to="{ name: 'profile' }" class="btn btn-secondary"><i class="fa fa-save"></i>Trở về</router-link>
        </div>
    </form>
</template>

<script>
import {QuillEditor} from "@vueup/vue-quill";
import { toast } from 'vue3-toastify';
import {useRouter} from "vue-router";

export default {
    name: 'CreatePost',
    data() {
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
            content: '',
            categories: [],
            fileInput: null,
            selectedFileUrl: null,
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
    methods: {
        async getCategory() {
            await axios.get('/api/get_all_category')
                .then(res => {
                    this.categories = res.data;
                });
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
            if(!this.fileInput) {
                toast.warning("Bạn chưa chọn ảnh bìa!",{
                    position: toast.POSITION.BOTTOM_RIGHT
                });
                return;
            }
            if(!this.content || this.content === '<p><br></p>') {
                toast.warning("Bạn chưa thêm nội dung!",{
                    position: toast.POSITION.BOTTOM_RIGHT
                });
                return;
            }

            const data = new FormData(this.$el);
            data.append('content', this.content);
            await axios.post('/api/save_post', data)
                .then(res => {
                    if(res.data.successMsg) {
                        toast.success(res.successMsg,{
                            position: toast.POSITION.BOTTOM_RIGHT
                        });
                        this.router.push({ name: 'profile' })
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
        await this.getCategory();
    }
}
</script>
