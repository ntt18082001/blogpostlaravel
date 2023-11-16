<template>
    <form class="mb-3 mt-3" autocomplete="off" enctype="multipart/form-data" v-if="profile" @submit.prevent="handleSubmitUserInfo">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group group-container">
                    <label class="control-label required">Ảnh đại diện</label>
                    <input name="avatar" id="img_path" type="file" ref="fileRef" @change="handleFileChange"
                           class="form-control fake-d-none" accept="image/*">
                    <div class="position-relative d-flex justify-content-center">
                        <input type="button" @click="handleChooseFile" class="btn btn-choose-file w-100 h-100 position-absolute">
                        <div class="selectedImages w-100">
                            <img v-if="selectedFileUrl" class="image-review w-100" :src="selectedFileUrl"/>
                            <img class="image-review w-100" :src="'/storage/avatar/' + profile.avatar" v-else-if="profile.avatar">
                            <img class="image-review w-100" v-else/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="full_name" class="form-label required">Họ và tên</label>
                    <input type="text" class="form-control" name="full_name" id="full_name" v-model="profile.full_name" required >
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label required">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone_number" ref="phoneNumber" id="phone_number" :value="profile.phone_number" required >
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label required">Địa chỉ</label>
                    <textarea class="form-control" id="address" name="address" required rows="3">{{profile.address}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="birth_day" class="form-label required">Ngày sinh</label>
                    <input type="date" class="form-control" name="birth_day" id="birth_day" :value="profile.birth_day" required >
                </div>
                <div>
                    <label for="gender" class="form-label required d-block mt-3">Giới tính</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" :checked="profile.gender === 0" id="male" name="gender" value="0" >
                        <label class="form-check-label" for="male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="female" :checked="profile.gender === 1" name="gender" value="1" >
                        <label class="form-check-label" for="female">Nữ</label>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success me-2">Cập nhật</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { toast } from "vue3-toastify";

export default {
    name: 'FormProfile',
    props: {
        profile: {
            type: Object
        },
        setUserInfo: {
            type: Function
        }
    },
    data() {
        return {
            fileInput: null,
            selectedFileUrl: null,
        }
    },
    methods: {
        async handleSubmitUserInfo() {
            const regex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;

            if(!regex.test(this.$refs.phoneNumber.value)) {
                toast.warning("Số điện thoại không đúng định dạng!",{
                    position: toast.POSITION.BOTTOM_RIGHT
                });
                return;
            }

            const formData = new FormData(this.$el);
            await axios.post('/api/profile/update_info', formData)
                .then(res => {
                    this.setUserInfo(res.data.data);
                    toast.success("Cập nhật thông tin thành công!", {
                        position: toast.POSITION.BOTTOM_RIGHT
                    });
                })
                .catch(err => {
                    toast.error(err.message, {
                        position: toast.POSITION.BOTTOM_RIGHT
                    });
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
    },
}
</script>
