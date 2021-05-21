function toolSubmit() {
    var msg = 'Calculating...';
    var d = jQuery('#distance').val();
    if (!d) {
        toolMessage('The distance you ran is required.', true);
        return false;
    }
    d = Math.round(d * 100000) / 100000;
    if (!d) {
        toolMessage('The distance you entered wasnâ€™t understood. Please try again.', true);
        return false;
    } else if (d < 0) {
        toolMessage('The distance you ran canâ€™t be negative.', true);
        return false;
    }
    var du = jQuery('input[name=distance_units]:checked').val();
    if (du == 'm') {
        var d = 1.60934 * d;
    }
    if ((d < 0.1) || (d > 1000)) {
        toolMessage('The distance you entered falls outside the limits of this calculator.', true);
        return false;
    }
    msg = 'You ran ' + d + ' kilometers ';
    var t = jQuery('#time').val();
    if (!t) {
        toolMessage('How long your ran is required.', true);
        return false;
    }
    var tt = t.match(/([0-9:]+)/);
    if (!tt) {
        toolMessage('The time you entered wasnâ€™t understood. Please try again using the <em>hours:minutes:seconds</em> syntax. Hereâ€™s an example: 2:52:11.', true);
        return false;
    }
    tt = tt['0'];
    var ta = tt.split(':');
    if (ta.length == 3) {
        var s = Math.round(ta['0'] * 3600) + Math.round(ta['1'] * 60) + Math.round(ta['2']);
    } else if (ta.length == 2) {
        var s = Math.round(ta['0'] * 60) + Math.round(ta['1']);
    } else {
        toolMessage('The time you entered wasnâ€™t understood. Please try again using the <em>hours:minutes:seconds</em> syntax. Hereâ€™s an example: 2:52:11.', true);
        return false;
    }
    msg = msg + ' and ' + s + ' seconds.';
    var pace = s / d;
    if ((pace < 140) | (pace > 1200)) {
        toolMessage('The pace calculated from the distance and time you entered falls outside the limits of this calculator.', true);
        return false;
    }
    var w = jQuery('#weight').val();
    if (!w) {
        toolMessage('Your weight is required.', true);
        return false;
    }
    w = Math.round(w * 100000) / 100000;
    if (!w) {
        toolMessage('The weight you entered wasnâ€™t understood. Please try again.', true);
        return false;
    } else if (w < 0) {
        toolMessage('Your weight canâ€™t be negative.', true);
        return false;
    }
    msg = msg + ' and ' + s + ' seconds.';
    if (jQuery('input[name=weight_units]:checked').val() == 'lb') {
        var w = 0.453592 * w;
    }
    if ((w < 35) | (w > 250)) {
        toolMessage('The weight that you entered falls outside the limits of this calculator.', true);
        return false;
    }
    msg = msg + ' You weigh ' + w + ' kilograms.';
    var cal = Math.round(d * w * 1.036);
    var calpkm = Math.round(w * 1.036);
    var calpm = Math.round(1.60934 * w * 1.036);
    var calph = Math.round((d * w * 1.036) * (3600 / s));
    if (du == 'm') {
        var df = (Math.round(d * 62.1371) / 100) + '-mile';
        var cbr = calpm + ' calories per mile';
    } else {
        var df = (Math.round(d * 100) / 100) + '-kilometer';
        var cbr = calpkm + ' calories per kilometer';
    }
    msg = 'You burned <strong>' + cal + ' calories</strong> on your ' + df + ' run.' + ' At that pace, your calorie burn rate is ' + cbr + ' and ' + calph + ' calories per hour.';
    toolMessage(msg, false);
}
function toolMessage(msg, error) {
    jQuery('#tool_status').removeClass();
    if (error) {
        jQuery('#tool_status').addClass('messages error messages--error');
    } else {
        jQuery('#tool_status').addClass('messages status messages--status');
    }
    jQuery('#tool_status').html(msg).show();
}
function swapUnit() {
    if (jQuery('input[name=distance_units]:checked').val() == 'm') {
        jQuery('#distance_units_text').html('mile');
    } else if (jQuery('input[name=distance_units]:checked').val() == 'km') {
        jQuery('#distance_units_text').html('kilometer');
    }
}
function scrollUpForm() {
    jQuery(window).scrollTop(jQuery('#tool_status').offset().top);
}