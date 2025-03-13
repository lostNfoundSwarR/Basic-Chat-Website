window.addEventListener("load", () => {
     navigator.sendBeacon("php/onload.php", new Blob());
});

window.addEventListener("beforeunload", () => {
     navigator.sendBeacon("php/unload.php", new Blob());
});