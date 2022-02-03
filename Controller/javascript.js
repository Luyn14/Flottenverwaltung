function myCrew() {
    var x = document.getElementById("crew_style");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function myShip() {
    var x = document.getElementById("ship_style");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function myEquipment() {
    var x = document.getElementById("equipment_style");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function myCargo() {
    var x = document.getElementById("cargo_style");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function myAmmunition() {
    var x = document.getElementById("ammunition_style");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function myEquip() {
    var x = document.getElementById("equip_style");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function availableMoons() {
    var x = document.getElementById("MoonID");
    if (x.value = 1);
}


function validateTextField() {

    let select = document.querySelector('#selected');
    let selected = select.options[select.selectedIndex];
    let usedField = selected.innerHTML;
    let Field = document.querySelector('#emergency');

    if (usedField == "Bug") {
        Field.selectedIndex = 3;
        Field.disabled = true;
    } else {
        Field.selectedIndex = 0;
        Field.disabled = false;
    }

}