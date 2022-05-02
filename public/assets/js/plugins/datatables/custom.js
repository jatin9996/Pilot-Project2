/**
 * @param status
 * @returns {*}
 */
function statusSpan(status) {
    let statusArr = {
        0: {'title': 'Inactive', 'class': 'badge-danger'},
        1: {'title': 'Active', 'class': ' badge-success'}
    };
    if (typeof statusArr[status] === 'undefined') {
        return data;
    }
    return '<span class="badge ' + statusArr[status].class + ' kt-badge--inline kt-badge--pill">' + statusArr[status].title + '</span>';
}

/**
 * @param status
 * @returns {*|{Type: string, BaseFont: a.embed.name, Encoding: string, Subtype: string}|{ToUnicode: *, Type: string, BaseFont: *, Encoding: string, DescendantFonts: [*], Subtype: string}|string}
 */
function userStatus(status) {
    let statusArr = {
        0: {'title': 'Inactive', 'class': 'badge-danger'},
        1: {'title': 'Active', 'class': 'badge-success'}
        // 2: {'title': 'OTP Not Verify', 'class': 'badge-info'}
    };
    if (typeof statusArr[status] === 'undefined') {
        return data;
    }
    return '<span class="badge ' + statusArr[status].class + ' kt-badge--inline kt-badge--pill">' + statusArr[status].title + '</span>';
}

/**
 * @param status
 * @returns {*|{Type: string, BaseFont: a.embed.name, Encoding: string, Subtype: string}|{ToUnicode: *, Type: string, BaseFont: *, Encoding: string, DescendantFonts: [*], Subtype: string}|string}
 */
function examComplete(status) {
    let statusArr = {
        0: {'title': 'NotCompleted', 'class': 'kt-badge--danger'},
        1: {'title': 'Completed', 'class': ' kt-badge--success'}
    };
    if (typeof statusArr[status] === 'undefined') {
        return data;
    }
    return '<span class="kt-badge ' + statusArr[status].class + ' kt-badge--inline kt-badge--pill">' + statusArr[status].title + '</span>';
}

/**
 * @param status
 * @returns {*|{Type: string, BaseFont: a.embed.name, Encoding: string, Subtype: string}|{ToUnicode: *, Type: string, BaseFont: *, Encoding: string, DescendantFonts: [*], Subtype: string}|string}
 */
function isPaperCheck(status) {
    let statusArr = {
        0: {'title': 'Remaining', 'class': 'kt-badge--danger'},
        1: {'title': 'Checked', 'class': ' kt-badge--success'}
    };
    if (typeof statusArr[status] === 'undefined') {
        return data;
    }
    return '<span class="kt-badge ' + statusArr[status].class + ' kt-badge--inline kt-badge--pill">' + statusArr[status].title + '</span>';
}

/**
 * @param meta
 * @returns {*}
 */
function serialNo(meta) {
    return meta.row + meta.settings._iDisplayStart + 1;
}

/**
 *
 * @param error
 * @param message
 */
function toastrMsg(error, message) {
    if (error === "success") {
        toastr.success(message)
    } else if (error === "error") {
        toastr.error(message)
    }
}

function progressBarBlock() {
    $("body").block({
        message: '<i class="icon-spinner spinner"></i>',
        overlayCSS: {
            backgroundColor: '#1B2024',
            opacity: 0.85,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none',
            color: '#fff'
        }
    });
}

function isNullAndUndef(variable) {

    if (variable !== null && variable !== undefined) {

        return variable;
    }
    return "";
}

function progressBarUnBlock() {
    $("body").unblock();
}
