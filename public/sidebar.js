var open = 0;

function manageNav(){
    if(open === 0){
        openNav();
        open = 1;
    } else {
        closeNav();
        open = 0;
    }
}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    console.log("funziona");
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
