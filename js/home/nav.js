document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('header nav');
    const cover = document.querySelector('.cover');

    if (!toggle || !nav || !cover) return;

    const icon = toggle.querySelector('.nav-toggle i');

    const closeNav = () => {
        nav.classList.remove('nav-open');
        toggle.setAttribute('aria-expanded', 'false');
        icon.classList.remove('fa-xmark');
        icon.classList.add('fa-bars');
        cover.style.display = 'none';
        document.body.style.overflow = '';
    };

    const openNav = () => {
        nav.classList.add('nav-open');
        toggle.setAttribute('aria-expanded', 'true');
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark');
        cover.style.display = 'block';
        document.body.style.overflow = 'hidden';
    };

    toggle.addEventListener('click', () => {
        if (nav.classList.contains('nav-open')) {
            closeNav();
        } else {
            openNav();
        }
    });

    cover.addEventListener('click', closeNav);

    nav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeNav);
    });
});
