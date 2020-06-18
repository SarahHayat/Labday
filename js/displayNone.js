const togg2 = document.getElementById("display");
const d2 = document.getElementById('menu-none');
const d3 = document.getElementById('width');
togg2.addEventListener("click", () => {
    if (d2.style.visibility == "hidden" ) {
        d2.style.visibility= "visible";
        d2.style.width = "15%";
    } else {
        d2.style.visibility = "hidden";
        d2.style.width = "0%";

    }
});
