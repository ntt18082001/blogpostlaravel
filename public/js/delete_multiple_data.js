const colCheckbox = document.querySelectorAll('.checkbox-container');
const checkboxs = document.querySelectorAll('.js-check-element');
const delCount = document.getElementById('delCount');

document.getElementById('switchDeleteMultipleData').addEventListener('change', function(ev) {
    const btnRemove = document.querySelector('.js-delete-multiple');
    if (this.checked) {
        colCheckbox.forEach(item => item.classList.remove('d-none'));
        btnRemove.classList.remove('d-none');
    } else {
        colCheckbox.forEach(item => item.classList.add('d-none'));
        btnRemove.classList.add('d-none');
    }
});

document.getElementById('js-check-all').addEventListener('change', function(ev) {
    let isCheckAll = this.checked;

    if (isCheckAll) {
        checkboxs.forEach(item => {
            let statusBefore = item.checked;
            item.checked = isCheckAll;
            if (item.checked !== statusBefore) {
                item.checked = true;
            }
        });
    } else {
        checkboxs.forEach(item => {
            item.checked = false;
        });
    }
    updateCountDelete();
});

checkboxs.forEach(item => {
    item.addEventListener('change', function(ev) {
        updateCountDelete();
    });
});

const updateCountDelete = () => {
    delCount.textContent = Array.from(checkboxs).filter(item => item.checked).length;
};

document.querySelector('.js-delete-multiple').addEventListener('click', function(ev) {
    let countDelete = Number(delCount.textContent);
    if (countDelete === 0) {
        alert(`Chưa chọn dữ liệu để xóa!`);
        return;
    }
    if(confirm(`Xác nhận xóa [${countDelete}] dữ liệu!`) === true) {
        var ids = Array.from(checkboxs).filter(item => item.checked).map(item => item.value);
        let url = `/admin/post_comment/delete_multiple/${ids.toString()}`;
        location.assign(url);
    }
});
