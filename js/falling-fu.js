// 创建福字元素并开始飘落动画
function createFallingFu() {
    const fu = document.createElement('span');
    fu.classList.add('fu-character');
    fu.textContent = '福';
    const randomX = Math.random() * window.innerWidth;
    fu.style.left = `${randomX}px`;
    document.body.appendChild(fu);

    // 福字飘落到底部后移除
    fu.addEventListener('animationend', function () {
        fu.remove();
    });
}

// 定时生成福字
function startFallingFuInterval(interval) {
    setInterval(createFallingFu, interval);
}

export { createFallingFu, startFallingFuInterval };