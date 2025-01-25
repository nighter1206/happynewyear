<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>蛇年吉祥主题网站</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            position: relative;
        }

        /* 烟花特效容器样式 */
        .fireworks-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* 其他内容容器样式 */
        .content-container {
            position: relative;
            z-index: 1;
            padding: 20px;
            color: white;
        }

        canvas {
            display: block;
        }
    </style>
</head>

<body>
    <!-- 烟花特效容器 -->
    <div class="fireworks-container">
        <canvas id="fireworksCanvas"></canvas>
    </div>

    <!-- 其他内容容器 -->
    <div class="content-container">
        <header>
            <h1>蛇年吉祥，喜乐安康</h1>
        </header>

        <!-- 新年祈愿区域 -->
        <div class="wish-section">
            <textarea class="wish-input" placeholder="写下你的新年祈愿吧~"></textarea>
            <button class="submit-button">提交祈愿</button>
        </div>

        <!-- 祈愿展示区域 -->
        <div class="wish-display"></div>

        <!-- 音乐控制区域 -->
        <div class="music-control">
            <select></select>
            <button class="play">播放</button>
            <button class="pause">暂停</button>
        </div>
    </div>

    <script type="module">
        import { initMusicPlayer } from '../js/music-player.js';
        import { startFallingFuInterval } from '../js/falling-fu.js';

        // 初始化音乐播放器
        initMusicPlayer();

        // 开始福字飘落动画
        startFallingFuInterval(3000);

        // 页面加载时刷新祈愿列表
        document.addEventListener('DOMContentLoaded', async () => {
            await refreshWishList();
        });

        // 处理祈愿提交
        const wishInput = document.querySelector('.wish-input');
        const submitButton = document.querySelector('.submit-button');
        const wishDisplay = document.querySelector('.wish-display');

        submitButton.addEventListener('click', async () => {
            const wishText = wishInput.value;
            if (wishText.trim() === '') return;

            try {
                const response = await fetch('../backend/wish-handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `wish=${encodeURIComponent(wishText)}`
                });

                const data = await response.json();
                if (data.status === 'success') {
                    wishInput.value = '';
                    alert(data.blessing);
                    // 手动刷新祈愿列表
                    await refreshWishList();
                }
            } catch (error) {
                console.error('祈愿提交出错:', error);
            }
        });

        // 刷新祈愿列表
        async function refreshWishList() {
            try {
                const response = await fetch('../backend/get-wishes.php');
                const wishes = await response.json();
                wishDisplay.innerHTML = '';
                wishes.forEach(wish => {
                    const newWish = document.createElement('div');
                    newWish.classList.add('wish-item');
                    newWish.innerHTML = `<span>${wish.nickname}:</span> ${wish.wish}`;
                    wishDisplay.appendChild(newWish);
                });
            } catch (error) {
                console.error('刷新祈愿列表出错:', error);
            }
        }
    </script>
    <script src="fireworks.js"></script>
</body>

</html>