let categoryMenu = document.getElementById("categoryList");

/**
 * Create drop down list for menu (category)
 */
function createListMenu() {
    let xml = new XMLHttpRequest();
    xml.open("GET", "../../api/category/getCategories.php")
    xml.responseType = "json"

    xml.onload = function () {
        let response = xml.response;
        let div = document.createElement("div");
        div.id = "divCategories";

        response.forEach(function (e) {
            let subDiv = document.createElement("div");
            let a = document.createElement("a");
            a.innerHTML = e;

            div.appendChild(subDiv);
            subDiv.appendChild(a);
        })
    }
    xml.send();
}

if(categoryMenu) {
    categoryMenu.addEventListener("click", function () {
        createListMenu();
    })
}
