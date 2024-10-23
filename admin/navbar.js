document.addEventListener('DOMContentLoaded', () => {
    const currentUrl = window.location.pathname;  // ดึง URL ปัจจุบัน

    const navLinks = document.querySelectorAll('.nav-link');  // เลือกทุก nav-link

    navLinks.forEach(link => {
        // เช็คว่าค่า href ของ link ตรงกับ URL ปัจจุบันหรือไม่
        if (link.getAttribute('href') === currentUrl) {
            link.classList.add('active');  // ถ้าตรง ให้เพิ่มคลาส 'active'
        } else {
            link.classList.remove('active');  // ถ้าไม่ตรง เอาคลาส 'active' ออก
        }
    });
});
