document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("keydown", function (event) {
        switch (event.key) {
            case "ArrowUp":
                document.getElementById("up").click();
                break;
            case "ArrowDown":
                document.getElementById("down").click();
                break;
            case "ArrowLeft":
                document.getElementById("left").click();
                break;
            case "ArrowRight":
                document.getElementById("right").click();
                break;
        }
    });
});
