let togg1 = document.getElementById("button");
let d1 = document.getElementById('chat');
togg1.addEventListener("click", () => {
    if (getComputedStyle(d1).display != "none") {
        d1.style.display = "none";
    } else {
        d1.style.display = "block";
        togg1.style.display ="none";

    }
});

