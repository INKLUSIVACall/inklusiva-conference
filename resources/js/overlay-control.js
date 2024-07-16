// check parent node has Class
const hasSomeParentTheClass = function(element, classname) {
    if (element.className == undefined) {
        return false;
    } else {
        if (element.className.split(' ').indexOf(classname) >= 0) return true;
        return element.parentNode && hasSomeParentTheClass(element.parentNode, classname);
    }
}

// toggle Overlays
const toggleOverlay = function(dataAreaId) {
    document.querySelector('body').classList.toggle(dataAreaId+'-open');
    toggleArea(dataAreaId);
}

// close Overlays on document click
const checkCloseOverlays = function(e) {
    // check and close navigation
    if (!hasSomeParentTheClass(e.target, 'overlay-navigation') && !hasSomeParentTheClass(e.target, 'item-navigation') && document.querySelector('body').classList.contains('overlay-navigation-open')) {
        toggleOverlay('overlay-navigation');
    }
}

export {hasSomeParentTheClass, checkCloseOverlays, toggleOverlay}
