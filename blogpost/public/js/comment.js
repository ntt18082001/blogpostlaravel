var btnReply = document.querySelector('.js-reply');
var templateReply = `<form class="mt-3" method="post">
                                            <input type="hidden" name="id" value="{post_id}">
                                            <input type="hidden" name="parent_id" value="{parent_id}">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="content"
                                                       placeholder="abc..."
                                                       aria-label="Recipient's username"
                                                       aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" type="submit"
                                                        id="button-addon2">
                                                    Comment
                                                </button>
                                            </div>
                                        </form>`;
btnReply.addEventListener("click", function() {
    let postId = this.getAttribute('data-post-id');
    let parentId = this.getAttribute('data-parent-id');
    templateReply = templateReply.replace('{post_id}', postId).replace('{parent_id}', parentId);
    console.log(templateReply);
});
