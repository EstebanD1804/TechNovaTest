document.addEventListener("DOMContentLoaded", () => {
    const images = [
        "monitor1.png", "imagen1.png", "imagen2.jpg",
        "imagen3.png", "imagen4.png", "monitor1.png", 
        "imagen1.png", "imagen2.jpg", "imagen3.png"
    ];

    const items = document.querySelectorAll(".carousel-item");
    let index = 0;

    setInterval(() => {
        index = (index + 1) % 3;

        items[0].querySelector("img").src = images[index % 3]; // monitor
        items[1].querySelector("img").src = images[3 + (index % 3)]; // headset
        items[2].querySelector("img").src = images[6 + (index % 3)]; // teclado
    }, 3000);
 // Galería de miniaturas
 const mainImage = document.getElementById("mainImage");
 document.querySelectorAll(".thumb").forEach(thumb => {
   thumb.addEventListener("click", () => {
     mainImage.src = thumb.dataset.large;
   });
 });
});