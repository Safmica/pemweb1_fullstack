function animateValue(id, start, end, duration, ext) {
    let startTime = null;

    const animate = (timestamp) => {
        if (!startTime) startTime = timestamp;
        const progress = timestamp - startTime;
        const currentValue = Math.floor(
            progress / duration * (end - start) + start
        );

        document.getElementById(id).innerText = currentValue + ext;

        if (progress < duration) {
            requestAnimationFrame(animate);
        } else {
            document.getElementById(id).innerText = end + ext;
        }
    };

    requestAnimationFrame(animate);
}

animateValue("achievement-1", 0, 97, 2000, '%');
animateValue("achievement-2", 0, 24, 2000, ' Years');
animateValue("achievement-3", 0, 100, 2000, ' Top');
animateValue("achievement-4", 0, 147, 2000, 'x');