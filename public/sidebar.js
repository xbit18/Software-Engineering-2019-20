let open = false;

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function manageNav(){
    if(!open){
        openNav();
        open = true;
    } else {
        closeNav();
        open = false;
    }
}
