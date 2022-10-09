document.getElementById("shareButton").addEventListener("click", downloadImg);

function hiddenClone(element) {
  // Create clone of element
  var clone = element.cloneNode(true);

  // Position element relatively within the
  // body but still out of the viewport
  var style = clone.style;
  style.position = "relative";
  style.top = window.innerHeight + "px";
  style.left = 0;
  // Append clone to body and return the clone
  document.body.appendChild(clone);
  return clone;
}

function downloadImg() {
  const fileName = `top`;
  var offScreen = document.querySelector(".imageContainer");
  window.scrollTo(0, 0);
  var clone = hiddenClone(offScreen);
  // Use clone with htm2canvas and delete clone
  html2canvas(clone, { scrollY: -window.scrollY }).then((canvas) => {
    var dataURL = canvas.toDataURL("image/png", 1.0);
    document.body.removeChild(clone);
    var link = document.createElement("a");
    link.href = dataURL;
    link.download = `${fileName}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });
}
