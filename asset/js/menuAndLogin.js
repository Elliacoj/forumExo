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
            subDiv.style.cssText = "width: 100%; height: 100%; border: none; border-bottom-left-radius: 0; border-bottom-right-radius: 0;";
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

/**
 * Change color of category menu
 */
function colorListCategory() {
    if(categoryMenu.style.color !== "lightblue") {
        categoryMenu.style.color = "lightblue";
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
            categoryMenu.style.color = "lightblue";
        }
    });

    document.body.addEventListener("click", function() {
        let divCategories = document.getElementById("divCategories")
        if(divCategories) {
            divCategories.remove();
            categoryMenu.addEventListener("mouseover", colorListCategory);
            categoryMenu.addEventListener("mouseleave", colorListCategory);
        }
    })
}

let createAccount = document.getElementById("createDiv");
let loginAccount = document.getElementById("loginDiv");

if(createAccount) {
    createAccount.style.display = "none";
    let buttonSwitchCreate = document.getElementById("buttonSwitchCreate");
    let buttonSwitchLogin = document.getElementById("buttonSwitchLogin");
    let buttonCreate = document.getElementById("buttonCreate");
    let passwordInput = document.getElementById("createPassword");
    let passwordCheckInput = document.getElementById("createCheckPassword");

    buttonSwitchCreate.addEventListener("click", switchAccount);
    buttonSwitchLogin.addEventListener("click", switchAccount);

    buttonCreate.disabled = "true";

    passwordInput.addEventListener("keyup", function () {
        check(buttonCreate, passwordInput, passwordCheckInput);
    })

    passwordCheckInput.addEventListener("keyup", function () {
        check(buttonCreate, passwordInput, passwordCheckInput);
    })
}

function check(button, content, contentCheck) {
    const regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$");
    if((!regex.test(content.value) === false) && (content.value === contentCheck.value)) {
        button.removeAttribute("disabled");
        content.style.borderColor = "black";
        contentCheck.style.borderColor = "black";
    }
    else {
        button.disabled = "true";
        content.style.borderColor = "red";
        contentCheck.style.borderColor = "red";
    }
}


function switchAccount() {
    if(createAccount.style.display === "none") {
        createAccount.style.height = "0";
        loginAccount.animate([
            { height: "340px" },
            { height: "0" }
        ], {
            duration: 500,
            iterations: 1
        });

        setTimeout(function () {
            loginAccount.style.display = "none";
            createAccount.style.display = "block";
            createAccount.animate([
                { height: "0" },
                { height: "520px" }
            ], {
                duration: 500,
                iterations: 1
            });

            setTimeout(function () {
                createAccount.style.height = "520px";
            }, 490);
        }, 490);
    }
    else  {
        loginAccount.style.height = "0";

        createAccount.animate([
            { height: "520px" },
            { height: "0" }
        ], {
            duration: 500,
            iterations: 1
        });

        setTimeout(function () {
            createAccount.style.display = "none";
            loginAccount.style.display = "block";
            loginAccount.animate([
                { height: "0" },
                { height: "340px" }
            ], {
                duration: 500,
                iterations: 1
            });

            setTimeout(function () {
                loginAccount.style.height = "340px";
            }, 490);
        }, 495);
    }
}

let welcomeUser = document.getElementById("welcomeUser");

if(welcomeUser) {
    welcomeUser.animate([
        { right: "+65%" },
        { right: "-60%" }
    ], {
        duration: 10000,
        iterations: Infinity
    });
}