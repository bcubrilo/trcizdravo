function calculateVDOT() {
    var t = 0, distance, multiplier, flag = 0;
    var d, c, i;
    var selectDist = new Array(.9144, 1.0, 402.336, 1609.344, 1000.0, 5000.0, 10000.0, 21097.494, 42194.988);
    for (var j = 0; j < 5; j++) {
        if (isNaN(document.vdotForm.elements[j].value)) {
            flag = 1;
        }
    }
    if (flag == 1)
        alert("Please enter numbers only - no text!");
    for (var j = 0; j < 3; j++) {
        t += (Math.pow(60, 1 - j)) * (document.vdotForm.hms[j].value);
    }
    distance = selectDist[document.vdotForm.distances.value];
    multiplier = document.vdotForm.mult.value;
    d = distance * multiplier;
    c = -4.6 + .182258 * d / t + .000104 * d * d / t / t;
    i = .8 + .1894393 * Math.exp(-.012778 * t) + .2989558 * Math.exp(-.1932605 * t);
    document.vdotForm.displayVDOT.value = Math.round(1000 * c / i) / 1000;
    document.tableForm.inputVDOT.value = Math.round(1000 * c / i) / 1000;
}

function calculateTable() {
    var d, t, n, c, i, e, v, dc, di, dt, h, m, s;
    var displayDist = new Array(402.336, 1609.344, 5000, 10000, 21097.494, 42194.988);
    v = document.tableForm.inputVDOT.value;
    if (isNaN(v)) {
        alert("Please enter numerical values only. No text or blank spaces!");
    }
    for (var row = 0; row < 6; row++) {
        d = displayDist[row];
        t = d * .004;
        n = 0;
        do {
            c = -4.6 + .182258 * d / t + .000104 * d * d / t / t;
            i = .8 + .1894393 * Math.exp(-.012778 * t) + .2989558 * Math.exp(-.1932605 * t);
            e = Math.abs(c - i * v);
            dc = -.182258 * d / t / t - 2 * .000104 * d * d / t / t / t;
            di = -.012778 * .1894393 * Math.exp(-.012778 * t) - .1932605 * .2989558 * Math.exp(-.1932605 * t);
            dt = (c - i * v) / (dc - di * v);
            t -= dt;
            n++;
        }
        while (n < 10 && e > .1);
        h = Math.floor(t / 60);
        m = Math.floor(t % 60);
        s = Math.round(60 * (t - Math.floor(t)));
        document.tableForm.elements[3 * row + 2].value = h;
        document.tableForm.elements[3 * row + 3].value = m;
        document.tableForm.elements[3 * row + 4].value = s;
    }
}