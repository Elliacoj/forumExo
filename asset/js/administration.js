let buttonDropdown = document.querySelectorAll(".administrationDiv i");

buttonDropdown.forEach(function (e) {
    const style = window.getComputedStyle(e.parentElement.parentElement.parentElement, null);
    const height = Math.ceil(parseFloat(style.getPropertyValue('height'))) + 'px';
    e.parentElement.parentElement.parentElement.style.height = "70px";

    e.addEventListener("click", function () {
        if(Math.ceil(parseFloat(style.getPropertyValue('height'))) === 70) {
            dropDown(e, height);
        }
        else {
            dropDown(e, "70px");
        }

    });
});

function dropDown(e, height) {
    e.parentElement.parentElement.parentElement.animate([
        { height: height }
    ], {
        duration: 800,
        iterations: 1,
        fill: "forwards",
        easing: "linear"
    });
}

let buttonNewCategory = document.getElementById("sendNewCategory");
let newNameCategory = document.getElementById("addName");

buttonNewCategory.addEventListener("click", function () {
    if(newNameCategory.value !== '') {
        let xml = new XMLHttpRequest();
        let data = {'name': newNameCategory.value};

        xml.responseType = "json";
        xml.open("POST", "../../api/category/getCategories.php");
        xml.setRequestHeader('Content-Type', 'application/json');

        xml.send(JSON.stringify(data));
        newNameCategory.value = '';
        categoriesDropDown();
    }
});

let buttonUpdateCategory = document.getElementById("sendUpdateCategory");

categoriesDropDown();

function categoriesDropDown() {
    let dropDownCategories = document.querySelectorAll(".dropDownCategories");
    let xml = new XMLHttpRequest();
    xml.responseType = "json";
    xml.open("GET", "../../api/category/getCategories.php");
    xml.onload = function () {
        let response = xml.response;

        dropDownCategories.forEach(function (e) {
            e.innerHTML = '';
            response.forEach(function (r) {
                let option = document.createElement("option");
                option.innerHTML = r['name']
                option.value = r['id'];

                e.appendChild(option);
            });
        });

    }
    xml.send();
}