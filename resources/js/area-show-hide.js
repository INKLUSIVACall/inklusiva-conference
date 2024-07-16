// initialize Areas
window.addEventListener('load',
    function () {
    });

// set areas in animation-mode if necessary
const animateArea = function(dataAreaId) {
    // default anim time
    const animTimeDefault = 500;

    // active Viewport
    const activeViewport = getViewport();

    // add animation mode for specific area
    document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.add('activeAnimation');

    let animTime;
    // get anim time of specific area
    if (document.querySelector('[data-area-id="' + dataAreaId + '"]').getAttribute('data-anim-time-' + activeViewport)) {
        animTime = document.querySelector('[data-area-id="' + dataAreaId + '"]').getAttribute('data-anim-time-' + activeViewport);
    } else {
        animTime = animTimeDefault;
    }

    setTimeout(function () {
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.remove('activeAnimation');
    }, animTime);
}

// show area by dataAreaId
const showArea = function(dataAreaId) {
    animateArea(dataAreaId);
    setTimeout(function () {
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.remove('hide-' + getViewport());
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.add('visible');
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.remove('invisible');
    }, 0);
}

// hide area by dataAreaId
const hideArea = function(dataAreaId) {
    animateArea(dataAreaId);
    setTimeout(function () {
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.add('hide-' + getViewport());
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.remove('visible');
        document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.add('invisible');
    }, 0);
}

// hide area by dataAreaId
const toggleArea = function(dataAreaId) {
    animateArea(dataAreaId);
    setTimeout(function () {
        if (document.querySelector('[data-area-id="' + dataAreaId + '"]').classList.contains('visible')) {
            hideArea(dataAreaId);
        } else {
            showArea(dataAreaId);
        }
    }, 0);
}

export {animateArea, toggleArea, hideArea, showArea}

