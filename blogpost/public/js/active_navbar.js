const arrAction = ['user', 'category', 'post'];
const arrHref = window.location.href.split('/');
const listLi = document.querySelectorAll('.nav-item a');
var active = "";

listLi.forEach(item => {
    const splitHref = item.href.split('/');
    if(arrHref[arrHref.length-1].includes(splitHref[splitHref.length - 1])) {
        active = "active";
        item.classList.add(active);
    }
});
