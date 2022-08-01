var printar = document.getElementById('imageGenerated');

var shareButton = document.getElementById('shareButton');
shareButton.addEventListener('click', () => {
    /*
    html2canvas(printar, { allowTaint: false }).then(function (canvas) {
        navigator.share(canvas.toDataURL("image/png"));
    });
    */

    /*
    html2canvas(printar, { allowTaint: false }).then(function (canvas) {
        var imgsrc = canvas.toDataURL("image/png");
        console.log(imgsrc);

        const blob = fetch(imgsrc).blob();
        const file = new File([blob], 'fileName.png', { type: blob.type });
        navigator.share({
            title: 'Hello',
            text: 'Check out this image!',
            files: [file],
        })
    })*/

    getScreenshotOfElement(printar, 0, 0, $('#imageGenerated').width(), $('#imageGenerated').height(), async function (data) {
        // in the data variable there is the base64 image
        // exmaple for displaying the image in an <img>
        $("img#captured").attr("src", "data:image/png;base64," + data);

        var src = "data:image/png;base64," + data;
        var image = new Image();
        image.id = "pic";
        image.src = src;

        var blob = dataURLtoBlob(src)

        console.log(blob);
        var file = new File([blob], "picture.png", {type: 'image/png'});
        var filesArray = [file];
        if(navigator.canShare && navigator.canShare({ files: filesArray })) {
            navigator.share({
              text: 'some_text',
              files: filesArray,
              title: 'some_title'
            });
          }
    });
});

function getScreenshotOfElement(element, posX, posY, width, height, callback) {
    html2canvas(element, { width: width, height: height, useCORS: true, taintTest: false, allowTaint: false }).then(function (canvas) {
        var context = canvas.getContext('2d');
        var imageData = context.getImageData(posX, posY, width, height).data;
        var outputCanvas = document.createElement('canvas');
        var outputContext = outputCanvas.getContext('2d');
        outputCanvas.width = width;
        outputCanvas.height = height;

        var idata = outputContext.createImageData(width, height);
        idata.data.set(imageData);
        outputContext.putImageData(idata, 0, 0);
        callback(outputCanvas.toDataURL().replace("data:image/png;base64,", ""));
    });
}