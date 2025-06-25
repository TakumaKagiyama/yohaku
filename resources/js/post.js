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
