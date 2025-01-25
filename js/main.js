// 导入相关模块
import { checkAndInitUser } from './cookie-handler.js';
import { initMusicPlayer } from './music-player.js';
import { startFallingFuInterval } from './falling-fu.js';
import { sendWish } from './websocket.js';

// 初始化用户信息
const user = checkAndInitUser();
console.log('用户 ID:', user.userId, '昵称:', user.nickname);

// 初始化音乐播放器
const audio = initMusicPlayer();

// 开始福字飘落动画
startFallingFuInterval(3000);

// 处理用户祈愿提交
const wishInput = document.querySelector('.wish-input');
const submitButton = document.querySelector('.submit-button');
const wishDisplay = document.querySelector('.wish-display');

submitButton.addEventListener('click', function () {
    const wishText = wishInput.value;
    if (wishText.trim() !== '') {
        // 发送祈愿到服务器
        sendWish(wishText);
        wishInput.value = '';

        // 模拟发送祈愿到后端并接收祝福
        const blessing = getRandomBlessing();
        alert(blessing);
    }
});

// 模拟获取随机祝福
function getRandomBlessing() {
    const blessings = [
        '祝您蛇年行大运，福气满满！',
        '愿您在蛇年里阖家欢乐，幸福安康！',
        '蛇年到，好运到，祝您事事顺心！'
    ];
    const randomIndex = Math.floor(Math.random() * blessings.length);
    return blessings[randomIndex];
}