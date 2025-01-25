// 设置 Cookie
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// 获取 Cookie
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// 删除 Cookie
function deleteCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

// 检查并初始化用户 Cookie 和昵称
function checkAndInitUser() {
    let userId = getCookie('user_id');
    if (!userId) {
        // 生成唯一的用户 ID
        userId = 'user_' + Math.random().toString(36).substr(2, 9);
        setCookie('user_id', userId, 30);

        // 从预设的吉祥昵称列表中随机选取一个昵称
        const luckyNicknames = ['瑞祥龙儿', '福运蛇宝', '吉庆虎娃'];
        const randomIndex = Math.floor(Math.random() * luckyNicknames.length);
        const nickname = luckyNicknames[randomIndex];
        setCookie('nickname', nickname, 30);
    }
    return {
        userId: userId,
        nickname: getCookie('nickname')
    };
}

export { setCookie, getCookie, deleteCookie, checkAndInitUser };