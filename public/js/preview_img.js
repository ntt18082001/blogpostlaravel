document
    .querySelector(".btn-choose-file")
    .addEventListener("click", function (ev) {
        document.querySelector("#img_path").click();
    });

document.querySelector("#img_path").addEventListener("change", function (ev) {
    const [file] = ev.target.files;
    if (file) {
        document.querySelector(".image-review").src = URL.createObjectURL(file);
    }
});

document.querySelector('.js-preview').addEventListener('click', function(ev) {
    const modal = document.getElementById('modalPreviewPost');
    modal.querySelector('.modal-title').textContent = ('(Preview) ') + document.getElementById('title').value;
    modal.querySelector('.modal-body .container .content-blog').innerHTML = quill.root.innerHTML;
});
