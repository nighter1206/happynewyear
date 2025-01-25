// 初始化音乐播放器
function initMusicPlayer() {
    const musicSelect = document.querySelector('.music-control select');
    const playButton = document.querySelector('.music-control button.play');
    const pauseButton = document.querySelector('.music-control button.pause');
    const audio = new Audio();

    // 读取音乐列表
    fetch('./audio/music-list.json')
      .then(response => response.json())
      .then(musicList => {
            musicList.forEach(music => {
                const option = document.createElement('option');
                option.value = music.path;
                option.textContent = music.name;
                musicSelect.appendChild(option);
            });
        });

    // 监听音乐选择事件
    musicSelect.addEventListener('change', function () {
        const selectedMusic = musicSelect.value;
        // 调整音频文件路径
        audio.src = `./audio/${selectedMusic}`;
        audio.play();
    });

    // 监听播放按钮点击事件
    playButton.addEventListener('click', function () {
        audio.play();
    });

    // 监听暂停按钮点击事件
    pauseButton.addEventListener('click', function () {
        audio.pause();
    });

    return audio;
}

export { initMusicPlayer };