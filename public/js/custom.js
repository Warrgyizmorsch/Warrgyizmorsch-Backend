document.addEventListener("DOMContentLoaded", function () {
    const cursor = document.createElement("div");
    cursor.classList.add("custom-cursor");
    document.body.appendChild(cursor);

    const dot = document.createElement("div");
    dot.classList.add("cursor-dot");
    document.body.appendChild(dot);

    document.addEventListener("mousemove", (e) => {
        cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
        dot.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
    });

    // Apply hover effect on interactive elements
    document.querySelectorAll("a, button, .cta-btn").forEach((element) => {
        element.addEventListener("mouseenter", () => {
            cursor.classList.add("hover");
            dot.classList.add("hover"); // Dot fades out
        });
        element.addEventListener("mouseleave", () => {
            cursor.classList.remove("hover");
            dot.classList.remove("hover"); // Dot reappears smoothly
        });
    });
});
