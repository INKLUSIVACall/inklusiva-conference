const toggleNavigation = function(element) {
    if (element.currentTarget.parentElement.querySelector('ul')) {
        element.preventDefault();
        element.stopPropagation();
        if (element.currentTarget.parentElement.classList.contains('li-open')) {
            element.currentTarget.parentElement.classList.remove('li-open');
        } else {
            element.currentTarget.parentElement.classList.add('li-open');
        }
    }
}

const checkCloseNavigation = function(e){
    // check and close navigation
    if (!hasSomeParentTheClass(e.target, 'navigation')) {
        document.querySelectorAll('.navigation li').forEach(function(element) {
            element.classList.remove('li-open');
        });
    }
}

export {toggleNavigation, checkCloseNavigation}
