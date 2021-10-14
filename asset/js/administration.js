let buttonDropdown = document.querySelectorAll(".administrationDiv i");
let tableBody = document.getElementById("tbodyReport");

function reportList() {
    let xhr = new XMLHttpRequest();
    xhr.responseType = "json";
    xhr.open("GET", "../../api/report/report.php");
    xhr.onload = function () {
        let response = xhr.response;
        tableBody.innerHTML = "";
        if(response.length !== 0) {
            response.forEach(function (r) {
                let tr = document.createElement("tr");
                let tdTopic = document.createElement("td");
                let tdUser = document.createElement("td");
                let tdUserReport = document.createElement("td");
                let tdContent = document.createElement("td");
                let tdTopicLink = document.createElement("td");
                let topicA =document.createElement("a");
                let tdDecision = document.createElement("td");

                tdTopic.innerHTML = r['topicName'];
                tdUser.innerHTML = r['username'];
                tdUserReport.innerHTML = r['usernameReport'];
                tdContent.innerHTML = "Voir";
                tdContent.className = "buttonViewReport";
                tdContent.dataset.content = r['content'];
                topicA.innerHTML = 'Lien';
                topicA.href = '/index.php?controller=topic&action=view&topic=' + r['topicFk'] + '';
                tdDecision.innerHTML = "" +
                    "<i class=\"fas fa-check checkReport\" title=\"Vérifié\" data-comment=\"" + r['id'] + "\"></i>" +
                    "<i class=\"fas fa-trash-alt deleteReport\" title=\"Supprimer\" data-comment=\"" + r['id'] + "\"></i>";

                tableBody.appendChild(tr);
                tr.appendChild(tdTopic);
                tr.appendChild(tdUser);
                tr.appendChild(tdUserReport);
                tr.appendChild(tdContent);
                tr.appendChild(tdTopicLink);
                tdTopicLink.appendChild(topicA);
                tr.appendChild(tdDecision);

                tdContent.addEventListener("click", modalWindowsReport);
            })
        }
    }
    xhr.send();
    setTimeout(function () {
        let checkReport2 = document.querySelectorAll(".checkReport");
        let deleteReport2 = document.querySelectorAll(".deleteReport");

        if(checkReport2) {
            checkReport2.forEach(function (e) {
                e.addEventListener("click", function () {
                    decision(e.dataset.comment, 0);
                })
            })

            deleteReport2.forEach(function (e) {
                e.addEventListener("click", function () {
                    decision(e.dataset.comment, 1);
                })
            })
        }
    },600)
}

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
let updateNameCategory = document.getElementById("updateName")
let updateCategory = document.getElementById("updateCategory")

buttonUpdateCategory.addEventListener("click", function () {
    if(updateNameCategory.value !== '') {
        let xml = new XMLHttpRequest();
        let data = {'name': updateNameCategory.value, "id": updateCategory.value};

        xml.responseType = "json";
        xml.open("PUT", "../../api/category/getCategories.php");
        xml.setRequestHeader('Content-Type', 'application/json');

        xml.send(JSON.stringify(data));
        updateNameCategory.value = '';
        categoriesDropDown();
    }
})

let buttonDeleteCategory = document.getElementById("sendDeleteCategory");
let deleteCategory = document.getElementById("deleteCategory");

buttonDeleteCategory.addEventListener("click", function () {
    let xml = new XMLHttpRequest();
    let data = {"id": deleteCategory.value};

    xml.responseType = "json";
    xml.open("DELETE", "../../api/category/getCategories.php");
    xml.setRequestHeader('Content-Type', 'application/json');

    xml.send(JSON.stringify(data));
    categoriesDropDown();
})

categoriesDropDown();

/**
 * Get and add all option into dropdown categories
 */
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

let dropDownUserList = document.getElementById("updateUserRole");
let dropDownRole = document.getElementById("updateRole");

dropDownUserList.addEventListener("change", function () {
    dropDownRole.value = dropDownUserList.childNodes[dropDownUserList.selectedIndex].dataset.role;
})

/**
 * Get and add all option into dropdown categories
 */
function userDropDown() {
    let dropDownUser = document.querySelectorAll(".dropDownUser");

    let xml = new XMLHttpRequest();
    xml.responseType = "json";
    xml.open("GET", "../../api/userRole/getUserRole.php");
    xml.onload = function () {
        let response = xml.response;

        dropDownRole.innerHTML = '';
        response['role'].forEach(function (r) {
            if(r['name'] !== "admin") {
                let option = document.createElement("option");
                option.innerHTML = r['name'];
                option.value = r["id"];

                dropDownRole.appendChild(option);
            }

        });

        dropDownUser.forEach(function (e) {
            e.innerHTML = '';
            response["user"].forEach(function (r) {
                if((r['username'] !== "Elliacoj") && e.id !== "banUser" && e.id !== "unbanUser" && r['ban'] === 1) {
                    let option = document.createElement("option");
                    option.innerHTML = r['username'];
                    option.value = r['id'];
                    option.dataset.role = r['role'];

                    e.appendChild(option);
                }

                if((r['username'] !== "Elliacoj") && e.id === "banUser" && r['ban'] === 1) {
                    let option = document.createElement("option");
                    option.innerHTML = r['username'];
                    option.value = r['id'];
                    option.dataset.role = r['role'];

                    e.appendChild(option);
                }

                if((r['username'] !== "Elliacoj") && e.id === "unbanUser" && r['ban'] === 2) {
                    let option = document.createElement("option");
                    option.innerHTML = r['username'];
                    option.value = r['id'];
                    option.dataset.role = r['role'];

                    e.appendChild(option);
                }
            });
        });

        dropDownRole.value = response["user"][1]['role'];
    }
    xml.send();
}

userDropDown();

let buttonUpdateRole = document.getElementById("sendUpdateRole");

buttonUpdateRole.addEventListener("click", function () {
    if(dropDownUserList.value !== '') {
        let xml = new XMLHttpRequest();
        let data = {'role': dropDownRole.value, "idUser": dropDownUserList.value};

        xml.responseType = "json";
        xml.open("PUT", "../../api/userRole/getUserRole.php");
        xml.setRequestHeader('Content-Type', 'application/json');

        xml.send(JSON.stringify(data));

        userDropDown();
    }
});

let buttonBanUser = document.getElementById("sendBanUser");
let buttonUnbanUser = document.getElementById("sendUnbanUser")
let banUser = document.getElementById("banUser");
let unbanUser = document.getElementById("unbanUser");

buttonBanUser.addEventListener("click", function () {
    if(banUser.value !== '') {
        ban(2, banUser.value);
    }
})

buttonUnbanUser.addEventListener("click", function () {
    if(unbanUser.value !== '') {
        ban(1, unbanUser.value);
    }
})

function ban(val, userVal){
    let xml = new XMLHttpRequest();
    let data = {'id': userVal, "ban": val};

    xml.responseType = "json";
    xml.open("DELETE", "../../api/userRole/getUserRole.php");
    xml.setRequestHeader('Content-Type', 'application/json');

    xml.send(JSON.stringify(data));

    userDropDown();
}

dropDownButton();

function dropDownButton() {
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
}

let buttonViewReport = document.querySelectorAll(".buttonViewReport");

buttonViewReport.forEach(function (e) {
    e.addEventListener("click", modalWindowsReport);
});

function modalWindowsReport() {
    let button = document.querySelectorAll(".buttonViewReport");
    button.forEach(function (e) {
        e.removeEventListener("click", modalWindowsReport);
    });


    let div = document.createElement("div");
    let p = document.createElement("p");

    let buttonBack = document.createElement("button");

    p.innerHTML = this.dataset.content;
    buttonBack.innerHTML = "Retour";

    div.style.cssText = "position: absolute; background-color: #f0f0f0; width: 50%; border-radius: 5px; box-shadow: 5px 5px 5px darkgray; top: 40vh; left: 25vw;";
    p.style.cssText = "width: 60%; text-align: center; padding: 10px; margin: 10px 20%"
    buttonBack.style.cssText = "width: 20%; margin-left: 40%; margin-bottom: 10px;";

    div.appendChild(p);
    div.appendChild(buttonBack);
    document.body.appendChild(div);

    buttonBack.addEventListener("click", function () {
        button.forEach(function (e) {
            e.addEventListener("click", modalWindowsReport);
        });
        div.remove();
    });
}

let checkReport = document.querySelectorAll(".checkReport");
let deleteReport = document.querySelectorAll(".deleteReport");

if(checkReport) {
    checkReport.forEach(function (e) {
        e.addEventListener("click", function () {
            decision(e.dataset.comment, 0);
        })
    })

    deleteReport.forEach(function (e) {
        e.addEventListener("click", function () {
            decision(e.dataset.comment, 1);
        })
    })
}

function decision(id, type) {
    let xml = new XMLHttpRequest();
    let data = {'id': id, "type": type};

    xml.responseType = "json";
    xml.open("PUT", "../../api/report/report.php");
    xml.setRequestHeader('Content-Type', 'application/json');

    xml.send(JSON.stringify(data));

    reportList();
}