// var btnReply = document.querySelectorAll('.js-reply');
//
// btnReply.forEach((item) => {
//     item.addEventListener("click", function() {
//         let postId = this.getAttribute('data-post-id');
//         let parentId = this.getAttribute('data-parent-id');
//         let templateReply = `<form class="mt-3 form-reply">
//                                             <input type="hidden" name="post_id" value="${postId}">
//                                             <input type="hidden" name="parent_id" value="${parentId}">
//                                             <div class="input-group mb-3">
//                                                 <input type="text" class="form-control" name="content"
//                                                        placeholder="abc..."
//                                                        required
//                                                        aria-label="Recipient's username"
//                                                        aria-describedby="button-addon2">
//                                                 <button class="btn btn-outline-secondary js-submit" type="button"
//                                                         id="button-addon2">
//                                                     Comment
//                                                 </button>
//                                             </div>
//                                         </form>`;
//         resetCommentForm();
//         this.nextElementSibling.nextElementSibling.innerHTML = templateReply;
//     });
// });
//
// const resetCommentForm = () => {
//     document.querySelectorAll('.replyContainer').forEach(item => {
//         item.innerHTML = '';
//     });
// }

document.addEventListener('DOMContentLoaded', function () {
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
});

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
