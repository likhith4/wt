const display = document.getElementById("display");

function appendtoDisplay(input) {
    display.value += input;
}

function clearDisplay() {
    display.value = "";
}

function calculate() {
    try {
        let expression = display.value;

        // Handle square root (√)
        if (expression.includes("sqrt")) {
            expression = expression.replace(/sqrt(\d+(\.\d+)?)/g, (match, num) => Math.sqrt(num));
        }

        // Handle power (^)
        if (expression.includes("^")) {
            expression = expression.replace(/(\d+(\.\d+)?)\^(\d+(\.\d+)?)/g, (match, base, _, exponent) => Math.pow(base, exponent));
        }

        // Evaluate the remaining expression
        display.value = eval(expression);
    } catch {
        display.value = "ERR";
    }
}
