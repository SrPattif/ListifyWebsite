var printar = document.getElementById('imageGenerated');

var shareButton = document.getElementById('shareButton');
shareButton.addEventListener('click', () => {
    html2canvas(printar, { allowTaint: false }).then(function (canvas) {
        navigator.share(canvas.toDataURL("image/png"));
    });
});