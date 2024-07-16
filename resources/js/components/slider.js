window.Slider = {
    onInput: function (input, decimalSlider, unit) {
        let value = input.value;
        // Sonderfall für Slider mit Dezimalstellen (bspw. Volume)
        if (decimalSlider) {
            value = value * 100;
        }
        document.getElementById(input.dataset.spanId).innerHTML = `${value} ${unit ?? ''}`;
    },
    onInputWithValues: function (input, values) {
        let valuesArray = JSON.parse(values);
        document.getElementById(input.dataset.spanId).innerHTML = valuesArray[input.value];
        input.ariaValueText = valuesArray[input.value];
    }
};
