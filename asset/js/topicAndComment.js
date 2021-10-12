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

