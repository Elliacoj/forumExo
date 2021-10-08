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