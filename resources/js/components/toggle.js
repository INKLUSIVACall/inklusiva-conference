window.Toggle = {
    // This function lies on the span element and clicks the input in order to act like a label.
    // SH 13.09.: not in use anymore
    onClick: function (target) {
        target.click();
    }
};

document.addEventListener('DOMContentLoaded', function () {
    let togglesWithoutFixedLabels  = document.querySelectorAll('.on-off-label');
    if(togglesWithoutFixedLabels.length !== 0) {
        togglesWithoutFixedLabels.forEach(element => {
            element.querySelector('label').innerHTML = element.querySelector("input[type='checkbox']").checked ? 'an' : 'aus';
            element.querySelector("input[type='checkbox']").addEventListener('change', function () {
                element.querySelector('label').innerHTML = element.querySelector("input[type='checkbox']").checked ? 'an' : 'aus';
            });
        });
    }
});
