myID = document.getElementById("myID");

var myScrollFunc = function() {
    var y = window.scrollY;
    if (y >= 600) {
        myID.className = "no_back show"
    } else {
        myID.className = "no_back hide"
    }
};

window.addEventListener("scroll", myScrollFunc);