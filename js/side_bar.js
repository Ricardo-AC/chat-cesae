var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");

menu_btn.addEventListener("click", () => {
    if (document.getElementById("formElem").style.margin == "0px 0px 0px 20px") {
        document.getElementById("formElem").style.margin = "0px 0px 0px 200px";
        document.getElementById("formElem").style.width = "calc(100vw - 220px)";
    }
    else {
        document.getElementById("formElem").style.margin = "0px 0px 0px 20px";
        document.getElementById("formElem").style.width = "calc(100vw - 40px)";
    }
    sidebar.classList.toggle("active-nav");
    container.classList.toggle("active-cont");
});

$(document).ready(function () {
    menu_btn.click();
});