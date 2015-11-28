$(function () {
    if (typeof (HTML_AREAS_ACTIONS) != "undefined") {
        $('#newAction').bind('click', function (event) {
            addAction();
            event.preventDefault();
        });
    }

});


function removeAction(event, index) {
    event.preventDefault();
    var model = '#actions' + index;

    var numActions = $('.area-actions').length;
    $(model).remove();

    if (numActions === 1) {
        AUTO_INCREMENT = 0;
        $(model).remove();
    }
}

function addAction() {
    $('.area-actions').append(newAction(AUTO_INCREMENT++));
}

function newAction(index) {
    var exp1 = eval('/\\[' + 0 + '\\]/g');
    var exp2 = eval('/actions' + 0 + '/g');
    var exp3 = eval('/\\-' + 0 + '\\-/g');
    var exp4 = eval('/\\(event,' + 0 + '\\)/g');
    var html;

    html = HTML_AREAS_ACTIONS.replace(exp1, '[' + index + ']')
            .replace(exp2, 'actions' + index)
            .replace(exp3, '-' + index + '-')
            .replace(exp4, '(event,' + index + ')');

    return html;
}