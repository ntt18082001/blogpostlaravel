document.addEventListener('DOMContentLoaded', function () {
    // Hàm này là khi chuyển trang comment thì sẽ scroll xuống khung comment
    window.onload = function() {
        // Kiểm tra xem URL có tham số 'page' không
        const urlParams = new URLSearchParams(window.location.search);
        const pageParam = urlParams.get('page');

        // Nếu có tham số 'page', cuộn xuống chỗ có class 'comment-container'
        if (pageParam) {
            const commentContainer = document.querySelector('.comment-container');
            if (commentContainer) {
                commentContainer.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }

    // Chỗ này là khi DOM được load vào sau thì sẽ bắt sự kiện của comment-container để click các phần tử bên trong
    document.querySelector('.comment-container').addEventListener('click', function(event) {
        // Chỗ này là khi bấm vào nút reply sẽ hiện ra input để bình luận
        if (event.target.classList.contains('js-reply')) {
            // Xử lý khi nút "Reply" được click
            let parentId = event.target.getAttribute('data-parent-id');
            let postId = event.target.getAttribute('data-post-id');
            // Thêm logic xử lý khi nút "Reply" được click ở đây
            let templateReply = `<form class="mt-3 form-reply" method="post" onsubmit="return false">
                                            <input type="hidden" name="post_id" value="${postId}">
                                            <input type="hidden" name="parent_id" value="${parentId}">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="content"
                                                       placeholder="abc..."
                                                       required="required"
                                                       aria-label="Recipient's username"
                                                       aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary js-submit" type="submit"
                                                        id="button-addon2">
                                                    Gửi
                                                </button>
                                            </div>
                                        </form>`;
            resetCommentForm();
            event.target.nextElementSibling.nextElementSibling.innerHTML = templateReply;
        }

        // Submit khi trả lời bình luận
        if (event.target.classList.contains('js-submit')) {
            let form = document.querySelector('.form-reply');
            axios.post('/profile/comment', new FormData(form))
                .then(function (response) {
                    let resData = response.data;
                    let avatar = resData.author.avatar == null ? '/assets/images/users/user-dummy-img.jpg' : `/storage/avatar/${resData.author.avatar}`;
                    let templateComment = `<div class="d-flex gap-2 mt-2">
                                                        <img class="rounded-circle header-profile-user"
                                                             src="${avatar}"
                                                             alt="Header Avatar">
                                                        <div class="w-100">
                                                            <p class="my-auto mx-0"><strong>${resData.author.full_name}:</strong>
                                                                <span>${resData.comment.content}</span>
                                                            </p>
                                                            <span>${formatDateTime(resData.comment.created_at)}</span>
                                                        </div>
                                                    </div>`;
                    document.querySelector(`.replyCommentContainer${resData.comment.parent_id}${resData.comment.post_id}`).insertAdjacentHTML('afterbegin', templateComment);
                });
            form.remove();
        }

        // Chỗ này là khi bấm vào nút load more sẽ hiện thêm bình luận
        if (event.target.classList.contains('js-load-more')) {
            let id = event.target.getAttribute('data-last-comment-id');
            let parentId = event.target.getAttribute('data-parent-id');
            let postId = event.target.getAttribute('data-post-id');
            axios.get(`/profile/load_more_comment/${id}_${parentId}_${postId}`)
                .then(function (response) {
                    const data = response.data.data;
                    data.comments.forEach(item => {
                        let avatar = item.author.avatar == null ? '/assets/images/users/user-dummy-img.jpg' : `/storage/avatar/${item.author.avatar}`;
                        let templateComment = `<div class="d-flex gap-2 mt-2">
                                                        <img class="rounded-circle header-profile-user"
                                                             src="${avatar}"
                                                             alt="Header Avatar">
                                                        <div class="w-100">
                                                            <p class="my-auto mx-0"><strong>${item.author.full_name}:</strong>
                                                                <span>${item.content}</span>
                                                            </p>
                                                            <span>${formatDateTime(item.created_at)}</span>
                                                        </div>
                                                    </div>`;
                        document.querySelector(`.replyCommentContainer${item.parent_id}${item.post_id}`).insertAdjacentHTML('beforeend', templateComment);
                    });
                    event.target.setAttribute('data-last-comment-id', data.comments[data.comments.length - 1].id);
                    if (data.has_more === 0) {
                        event.target.remove();
                    }
                });
        }
    });

    // Submit khi bình luận
    document.querySelector('.form-comment').addEventListener('submit', function (event) {
        let data = this;
        axios.post('/profile/comment', new FormData(data))
            .then(function (response) {
                let resData = response.data;
                let avatar = resData.author.avatar == null ? '/assets/images/users/user-dummy-img.jpg' : `/storage/avatar/${resData.author.avatar}`;
                let templateComment = `<div class="d-flex gap-2">
                                                    <img class="rounded-circle header-profile-user"
                                                         src="${avatar}"
                                                         alt="Header Avatar">
                                                    <div class="w-100">
                                                        <p class="my-auto mx-0"><strong>${resData.author.full_name}:</strong>
                                                            <span>${resData.comment.content}</span></p>
                                                        <button class="d-inline-block btn js-reply"
                                                                data-parent-id="${resData.comment.id}" data-post-id="${resData.comment.post_id}">
                                                            Reply
                                                        </button>
                                                        <span>${formatDateTime(resData.comment.created_at)}</span>
                                                        <div class="replyContainer"></div>
                                                    </div>
                                                </div>`;
                document.querySelector('.comment-container').insertAdjacentHTML('afterbegin', templateComment);
            });
        let eleNoComment = document.querySelector(".comment-container .no-comment");
        if (eleNoComment !== null) {
            eleNoComment.remove();
        }
        this.reset();
        event.preventDefault();
    });

    // Chỗ này là khi ấn nút trả lời bình luận thì sẽ chuyển form sang chỗ khác
    const resetCommentForm = () => {
        document.querySelectorAll('.replyContainer').forEach(item => {
            item.innerHTML = '';
        });
    }

    // Hàm này để format ngày tháng năm
    function formatDateTime(inputDateTime) {
        const date = new Date(inputDateTime);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        return formattedDateTime;
    }
});
