let buttonUpdate = document.getElementById("updateTopic");
let buttonArchived = document.getElementById("archivedTopic");

if(buttonUpdate) {
    buttonUpdate.addEventListener("click", function () {
        buttonTopic(buttonUpdate, "update");
    });

    buttonArchived.addEventListener("click", function () {
        buttonTopic(buttonArchived, "archived");
    });
}

/**
 * Create a session (topic) and redirects into controller topic
 * @param button
 * @param action
 */
function buttonTopic(button, action) {
        let xhr = new XMLHttpRequest();
        let data = {"session": button.dataset.id}
        xhr.responseType = "json";
        xhr.open("PUT", "../../api/session/session.php");

        xhr.send(JSON.stringify(data));
        setTimeout(function () {
            window.location = "../../index.php?controller=topic&action=" + action + "";
        }, 1000);
}

let buttonDelete = document.getElementById("deleteTopic");

if(buttonDelete) {
    buttonDelete.addEventListener("click", modalWindows);
}

function modalWindows() {
    buttonDelete.removeEventListener("click", modalWindows);

    let div = document.createElement("div");
    let pTitle = document.createElement("p");
    let buttonConfirm = document.createElement("button");
    let buttonBack = document.createElement("button");

    pTitle.innerHTML = "Voulez vous vraiment supprimer ce topic?"
    buttonConfirm.innerHTML = "Confirmer";
    buttonBack.innerHTML = "Annuler";

    div.style.cssText = "position: absolute; background-color: #f0f0f0; width: 50%; border-radius: 5px; box-shadow: 5px 5px 5px darkgray; top: 20vh; left: 25vw;";
    pTitle.style.cssText = "width: 100%; text-align: center; padding-top: 10px;"
    buttonConfirm.style.cssText = "width: 20%; margin-left: 28.5%; margin-bottom: 10px;";
    buttonBack.style.cssText = "width: 20%; margin-left: 5%; margin-bottom: 10px;";

    div.appendChild(pTitle);
    div.appendChild(buttonConfirm);
    div.appendChild(buttonBack);
    document.body.appendChild(div);

    buttonConfirm.addEventListener("click", function () {
        buttonTopic(buttonDelete, "delete");
    });

    buttonBack.addEventListener("click", function () {
        buttonDelete.addEventListener("click", modalWindows);
        div.remove();
    })
}

let commentList = document.getElementById("commentList");
let commentContent = document.getElementById("commentContent");
let buttonContent = document.getElementById("sendComment");

if(commentList) {
    listComment(commentList);

    buttonContent.addEventListener("click", function () {
        if(commentContent.value !== "") {
            let xml = new XMLHttpRequest();
            let data = {"content": commentContent.value};

            xml.responseType = "json";
            xml.open("POST", "../../api/topic/topic.php");
            xml.setRequestHeader('Content-Type', 'application/json');

            xml.send(JSON.stringify(data));

            commentContent.value = "";
            listComment(commentList);
        }

    });
}

function listComment(divList) {
    let xml = new XMLHttpRequest();
    xml.responseType = "json";
    xml.open("GET", "../../api/topic/topic.php");
    xml.onload = function () {
        let response = xml.response;

        divList.innerHTML = '';
        response.forEach(function (r) {
            let div = document.createElement("div");
            let subDivLeft = document.createElement("div");
            let subDivRight = document.createElement("div");
            let divUsername = document.createElement("div");
            let divButton = document.createElement("div");

            subDivLeft.innerHTML = r['content'];
            divUsername.innerHTML = r['username'];

            divButton.innerHTML = "<i class=\"fas fa-trash-alt\" title=\"Supprimer\"></i><i class=\"fas fa-pen\" title=\"Modifier\"></i>"  +
                "<i class=\"fas fa-flag\" title=\"Signaler\"></i>";

            div.style.cssText = "width: 80%; margin: 2% auto; display: flex; background-color: white; padding: 2%; margin-top: 10px;"
            subDivLeft.style.cssText = "width: 80%;";
            subDivRight.style.cssText = "text-align: center; width: 20%; font-size: 1.5rem;";
            divUsername.style.cssText = " font-style: italic; color: darkcyan;";

            divList.appendChild(div);
            div.appendChild(subDivLeft);
            div.appendChild(subDivRight);
            subDivRight.appendChild(divUsername);
            subDivRight.appendChild(divButton);
        });
    }
    xml.send();
}

