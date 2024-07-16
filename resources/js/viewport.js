var viewportBbreakpoints = [0, 576, 768, 992, 1200, 1400];
var viewportNames = ['xs', 'sm', 'md', 'lg', 'xl', 'xxl'];
var viewport = '';
var viewportResize = '';

const getViewport = function() {
    // initialise viewport
    const determineViewport = determineViewportSize();

    if (!viewport) {
        viewport = determineViewport;
    } else {
        viewportResize = determineViewport;

        if (viewportResize != viewport) {
            viewport = viewportResize;
        }
    }
    return viewport;
}

const determineViewportSize = function ()  {
    // width of current viewport
    var currentViewportWidth = window.innerWidth;

    // xs
    const minXS = viewportBbreakpoints[0];
    const maxXS = viewportBbreakpoints[1] - 1;

    // sm
    const minSM = viewportBbreakpoints[1];
    const maxSM = viewportBbreakpoints[2] - 1;

    // md
    const minMD = viewportBbreakpoints[2];
    const maxMD = viewportBbreakpoints[3] - 1;

    // lg
    const minLG = viewportBbreakpoints[3];
    const maxLG = viewportBbreakpoints[4] - 1;

    // xl
    const minXL = viewportBbreakpoints[4];
    const maxXL = viewportBbreakpoints[5] - 1;

    // xxl
    const minXXL = viewportBbreakpoints[5] - 1;

    if (betweenValues(currentViewportWidth, minXS, maxXS)) {
        return viewportNames[0];
    }

    if (betweenValues(currentViewportWidth, minSM, maxSM)) {
        return viewportNames[1];
    }

    if (betweenValues(currentViewportWidth, minMD, maxMD)) {
        return viewportNames[2];
    }

    if (betweenValues(currentViewportWidth, minLG, maxLG)) {
        return viewportNames[3];
    }

    if (betweenValues(currentViewportWidth, minXL, maxXL)) {
        return viewportNames[4];
    }

    if (currentViewportWidth > minXXL) {
        return viewportNames[5];
    }
}

// check the with values to identify viewport
const betweenValues = function(x, min, max) {
    return x >= min && x <= max;
}

export {getViewport, determineViewportSize, betweenValues}
