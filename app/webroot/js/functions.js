
function sendAjax(where, what) {
    var $aj = $.ajax({
        url: where,
        method: 'POST',
        data: what
    });
    return $aj;
}

function appendAuthor($el, authorObj) {
    var c = $el.find("li").length;
    $el.append('<li class="list-group-item">\n\
                    <div class="row">\n\
                        <div class="col-xs-10">\n\
                            <span class="badge">' + (c + 1) + '</span> ' + authorObj.name + '</div>\n\
                        <div class="col-xs-1 text-right">\n\
                            <div>\n\
                                <button class="btn btn-default move move-up author-move-up" title="Move up" disabled="disabled"><span class="glyphicon glyphicon-chevron-up"></span></button>\n\
                            </div>\n\
                            <div>\n\
                                <button class="btn btn-default move move-down author-move-down" title="Move down" disabled="disabled"><span class="glyphicon glyphicon-chevron-down"></span></button>\n\
                            </div>\n\
                        </div>\n\
                        <div class="col-xs-1 text-center">\n\
                            <button class="btn btn-default remove-ref-author" title="Remove from the list"><span class="glyphicon glyphicon-remove"></span></button>\n\
                        </div>\n\
                    </div>\n\
                    <input type="hidden" name="TypificationReference[TypifRefAuthor][' + c + '][typif_ref_id]" value="" />\n\
                    <input type="hidden" name="TypificationReference[TypifRefAuthor][' + c + '][author_std_form]" value="' + authorObj.name + '" />\n\
                    <input type="hidden" name="TypificationReference[TypifRefAuthor][' + c + '][' + (authorObj.remote ? 'remote_author_id' : 'local_author_id') + ']" value="' + authorObj.id + '" />\n\
                </li>');
}

/**
 * Appends author name to the string of authors and creates hidden input field with author's id value
 * @param {type} $st parent element containing string to append to
 * @param {type} $he parent element for hidden inputs
 * @param {type} authorObj
 * @returns {undefined}
 */
function appendAuthorTxt($st, $he, authorObj) {
    var url = (authorObj.remote ? 'http://www.ipni.org/ipni/idAuthorSearch.do?id=' : '') + authorObj.id;
    //var dataId = 'data-id="' + authorObj.id + '"';
    var as = '<a href="' + url + '" data-id="' + authorObj.id + '" data-remote="' + authorObj.remote + '">' + authorObj.name + '</a>';
    $st.append(as);
}

function clear($form) {
    $form.find("input[type=text], textarea").val("");
}

function setBadge($item, val) {
    $item.find("span.badge").text(val);
}

function decrBadge($item) {
    var current = parseInt($item.find("span.badge").text());
    setBadge($item, current - 1);
}

function incrBadge($item) {
    var current = parseInt($item.find("span.badge").text());
    setBadge($item, current + 1);
}

function setItemNamePosition($item) {
    $item.find("input[type='hidden']").each(function (i) {
        var name = $(this).attr("name").replace(/\[\d+\]/, "[" + $item.index() + "]");
        $(this).attr("name", name);
    });
}

function fixMoveBtns($parent) {
    $parent.children().find(".move").removeAttr("disabled");
    $parent.children(":first-child").find(".move-up").attr("disabled", "disabled");
    $parent.children(":last-child").find(".move-down").attr("disabled", "disabled");
}

function publicationFields() {
    $("#publisher").hide();
    $("#editors").hide();
    $("#book").hide();
    $("#publication-type").change(function () {
        var val = $(this).val();
        switch (val) {
            case "1":
                $("#publisher").hide();
                $("#editors").hide();
                $("#book").hide();
                $("#volume").show();
                $("#issue").show();
                $("#journal").show();
                break;
            case "2":
                $("#publisher").show();
                $("#editors").hide();
                $("#book").hide();
                $("#volume").hide();
                $("#issue").hide();
                $("#journal").hide();
                break;
            case "3":
                $("#publisher").show();
                $("#editors").show();
                $("#book").show();
                $("#volume").hide();
                $("#issue").hide();
                $("#journal").hide();
                break;
            default:
                $("#publisher").hide();
                $("#editors").hide();
                $("#book").hide();
                $("#volume").show();
                $("#issue").show();
                $("#journal").show();
                break;
        }
    });
}