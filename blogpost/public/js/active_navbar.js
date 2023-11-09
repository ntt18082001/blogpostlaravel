const arrHref = window.location.href.split('/');
const listLi = document.querySelectorAll('.nav-item a');
var active = "";

listLi.forEach(item => {
    const splitHref = item.href.split('/');
    if (arrHref.length === splitHref.length) {
        if (splitHref[splitHref.length - 2].includes(arrHref[arrHref.length - 2])) {
            active = "active";
            item.classList.add(active);
        }
    }
});
