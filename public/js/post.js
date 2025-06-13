document.getElementById('menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('genre-menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
});

// コントローラーキー操作
document.addEventListener('keydown', function (e) {
    switch (e.key) {
        case "ArrowUp":
            document.getElementById("mypage").click();
            break;
        case "ArrowDown":
            document.getElementById("edit").click();
            break;
        case "ArrowRight":
            document.getElementById("next").click();
            break;
        case "ArrowLeft":
            document.getElementById("save").click();
            break;
    }
});
