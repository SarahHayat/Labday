let togg2 = document.getElementById("display");
let d2 = document.getElementById('display_none');
togg2.addEventListener("click", () => {
    if (getComputedStyle(d2).visibility == "hidden") {
        d2.style.visibility = "visible";
    } else {
        d2.style.visibility = "hidden";
    }
});