//segéd
function ID(nev) {
    return document.getElementById(nev);
}
function CLASS(nev) {
    return document.getElementsByClassName(nev);
}
function tag(nev) {
    return document.getElementsByTagName(nev);
}
function rideCon(szov) {
    console.log(szov);
}
//fugvenyek
function time() {
    var d = new Date();
    var hours = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();
    if (min < 10) {
        min = "0" + min;
    }
    if (sec < 10) {
        sec = "0" + sec;
    }
    let ido = hours + " : " + min;//+ " : " + sec;
    let datum = d.toLocaleDateString();
    ID("time").innerHTML = ido;
    ID("date").innerHTML = datum;
}

function init() {
    setInterval(time, 1000);
}

window.addEventListener("load", init, false);