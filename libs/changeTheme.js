var greenGradient = document.getElementById('greenGradient');
var vanusaGradient = document.getElementById('vanusaGradient');
var shiftyGradient = document.getElementById('shiftyGradient');
var summerGradient = document.getElementById('summerGradient');

var imgContent = document.getElementById('imgContent');

greenGradient.addEventListener('click', () => {
    imgContent.style.background = "rgb(20, 110, 51)";
    imgContent.style.background = "linear-gradient(145deg, rgba(20, 110, 51, 1) 0%, rgba(22, 129, 59, 1) 49%, rgba(29, 185, 84, 1) 100%)";

    greenGradient.classList.add("selected");
    vanusaGradient.classList.remove("selected");
    shiftyGradient.classList.remove("selected");
    summerGradient.classList.remove("selected");
});

vanusaGradient.addEventListener('click', () => {
    imgContent.style.background = "rgb(137, 33, 107)";
    imgContent.style.background = "linear-gradient(145deg, rgba(137, 33, 107, 1) 0%, rgba(218, 68, 83, 1) 100%)";

    greenGradient.classList.remove("selected");
    vanusaGradient.classList.add("selected");
    shiftyGradient.classList.remove("selected");
    summerGradient.classList.remove("selected");
});

shiftyGradient.addEventListener('click', () => {
    imgContent.style.background = "rgb(162, 171, 88)";
    imgContent.style.background = "linear-gradient(145deg, rgba(162, 171, 88, 1) 0%, rgba(99, 99, 99, 1) 100%)";

    greenGradient.classList.remove("selected");
    vanusaGradient.classList.remove("selected");
    shiftyGradient.classList.add("selected");
    summerGradient.classList.remove("selected");
});

summerGradient.addEventListener('click', () => {
    imgContent.style.background = "rgb(255,0,14)";
    imgContent.style.background = "linear-gradient(145deg, rgba(255,0,14,1) 0%, rgba(115,208,91,1) 100%)";

    greenGradient.classList.remove("selected");
    vanusaGradient.classList.remove("selected");
    shiftyGradient.classList.remove("selected");
    summerGradient.classList.add("selected");
});