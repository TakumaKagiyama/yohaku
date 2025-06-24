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

     // 🔹 ジャンルクリック時の処理を追加
    const genreItems = document.querySelectorAll('.genre-item');
    console.log("ジャンルアイテムの数:", genreItems.length); // ← 追加

    genreItems.forEach(item => {
        item.addEventListener('click', function () {
            const genreId = this.dataset.id;
            console.log("クリックされたジャンルID:", genreId); // ← 追加
            if (genreId) {
                window.location.href = `/post/genre/${genreId}`;
            }
        });
    });
});

