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

