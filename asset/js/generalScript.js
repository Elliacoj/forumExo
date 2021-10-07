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
        div.style.cssText = "width: 100%; margin-top: 15px; border: none;";

        response.forEach(function (e) {
            let subDiv = document.createElement("div");
            let a = document.createElement("a");
            subDiv.style.cssText = "width: 100%; height: 100%;";
            a.style.cssText = "display: block; width: 100%; text-align: center; padding-top: 5px";
            a.innerHTML = e;
            a.href = "";

            div.appendChild(subDiv);
            subDiv.appendChild(a);
            categoryMenu.appendChild(div);
        })
    }
    xml.send();
}

function colorListCategory() {
    if(categoryMenu.style.color !== "yellow") {
        categoryMenu.style.color = "yellow";
    }
    else {
        categoryMenu.style.color = "#f0f0f0";
    }
}

if(categoryMenu) {
    categoryMenu.addEventListener("mouseover", colorListCategory);
    categoryMenu.addEventListener("mouseleave", colorListCategory);

    categoryMenu.addEventListener("click", function () {
        let divCategories = document.getElementById("divCategories")

        if(!divCategories) {
            createListMenu();
            categoryMenu.style.cssText = ":hover"
            categoryMenu.removeEventListener("mouseover", colorListCategory);
            categoryMenu.removeEventListener("mouseleave", colorListCategory);
        }
        else {
            categoryMenu.style.color = "yellow";
        }
    });

    document.body.addEventListener("click", function() {
        let divCategories = document.getElementById("divCategories")
        console.log(1);
        if(divCategories) {
            divCategories.remove();
            categoryMenu.addEventListener("mouseover", colorListCategory);
            categoryMenu.addEventListener("mouseleave", colorListCategory);
        }
    })
}
