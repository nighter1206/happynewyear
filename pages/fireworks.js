// 获取 canvas 元素和其 2D 上下文
const canvas = document.getElementById('fireworksCanvas');
const ctx = canvas.getContext('2d');

// 设置 canvas 大小为窗口大小
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// 设置背景颜色为红色
function drawBackground() {
    ctx.fillStyle = 'red';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
}

// 烟花粒子类
class Particle {
    constructor(x, y, color) {
        this.x = x;
        this.y = y;
        this.color = color;
        this.opacity = 1;
        // 烟花粒子大小增加一倍
        this.size = (Math.random() * 2 + 1) * 2;
        this.speedX = (Math.random() - 0.5) * 5;
        this.speedY = (Math.random() - 0.5) * 5;
        this.gravity = 0.1;
    }

    // 更新粒子位置和透明度
    update() {
        this.x += this.speedX;
        this.y += this.speedY;
        this.speedY += this.gravity;
        this.opacity -= 0.01;
    }

    // 绘制粒子
    draw() {
        ctx.save();
        ctx.globalAlpha = this.opacity;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.restore();
    }
}

// 烟花类
class Firework {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.particles = [];
        this.exploded = false;
        this.color = getRandomColor();
        // 烟花粒子数量增加一倍
        this.createParticles();
    }

    // 创建烟花粒子
    createParticles() {
        for (let i = 0; i < 100; i++) {
            this.particles.push(new Particle(this.x, this.y, this.color));
        }
    }

    // 更新烟花状态
    update() {
        if (!this.exploded) {
            this.exploded = true;
        }
        this.particles.forEach((particle, index) => {
            particle.update();
            if (particle.opacity <= 0) {
                this.particles.splice(index, 1);
            }
        });
        if (this.particles.length === 0) {
            fireworks.splice(fireworks.indexOf(this), 1);
        }
    }

    // 绘制烟花
    draw() {
        this.particles.forEach(particle => {
            particle.draw();
        });
    }
}

// 获取随机颜色
function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// 存储所有烟花的数组
const fireworks = [];

// 点击事件处理函数，创建新的烟花
function createFirework(event) {
    const x = event.clientX;
    const y = event.clientY;
    fireworks.push(new Firework(x, y));
}

// 动画循环
function animate() {
    // 绘制红色背景
    drawBackground();
    fireworks.forEach(firework => {
        firework.update();
        firework.draw();
    });
    requestAnimationFrame(animate);
}

// 监听窗口点击事件
window.addEventListener('click', createFirework);

// 启动动画循环
animate();