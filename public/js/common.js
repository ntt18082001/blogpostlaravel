document.addEventListener("DOMContentLoaded", function () {
    // Tìm tất cả các phần tử có class "alert" và "js-alert"
    var alerts = document.querySelectorAll(".alert.js-alert");

    // Lặp qua từng phần tử và ẩn nó sau 4 giây
    alerts.forEach(function (alert) {
        setTimeout(function () {
            // Ẩn cảnh báo và thiết lập thuộc tính display thành "none"
            alert.style.transition = "0.3s ease";
            alert.style.height = "0";
            alert.style.padding = "0";
            alert.style.margin = "0";
            alert.style.border = "none";
            alert.style.overflow = "hidden";
            alert.style.display = "none";
        }, 4000);
    });
});
