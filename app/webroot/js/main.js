/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var prefix = "/Lectotypf";
//var prefix = "/lectotpf";

$(document).ready(function () {

    publicationFields();

    $("[data-toggle='tooltip']").tooltip();
    $("#collection-date1").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });
    $("#collection-date2").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

    $("#FilterPreviewForm select").change(function () {
        $("#FilterPreviewForm").submit();
    });

    $("#ApprovalForm input.approval").change(function () {
        $("#ApprovalForm").submit();
    });

    /*
     * autocomplete for Publications
     */
    $("#ref-publ").autocomplete({
        source: prefix + "/requests/publication.json",
        minLength: 2,
        select: function (event, ui) {
            $("#ref-publ").val(ui.item.label);
            $("#ref-publ-id").val(ui.item.value);
            $("#ref-publ-ipni").val(ui.item.ipni);
            $("#publication-state-icon").removeClass(); //hide glyphicon
            return false;
        },
        search: function (event, ui) {
            $("#publication-state-icon").removeClass().addClass("glyphicon glyphicon-refresh gly-spin"); //search began, show progress icon
        },
        response: function (event, ui) {
            if (ui.content.length === 0) { //search finished, show success or failure icon
                $("#publication-state-icon").removeClass().addClass("glyphicon glyphicon-remove");
            } else {
                $("#publication-state-icon").removeClass().addClass("glyphicon glyphicon-ok");
            }
        },
        type: 'json'
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>" + item.label + "<br />" + item.desc + ", " + (item.ipni ? '<span class="text-success">IPNI' : '<span class="text-warning">Local') + "</span></a>")
                .appendTo(ul);
    };

    /*
     * autocomplete for reference authors
     */
    $("#ref-authors").autocomplete({
        source: prefix + "/requests/authorsbhl.json",
        //minLength: 2,
        select: function (event, ui) {
            appendAuthor($("#reference-authors"), {id: ui.item.value, name: ui.item.label, remote: ui.item.remote});
            fixMoveBtns($("#reference-authors"));
            $(this).val('');
            $("#authors-ref-state-icon").removeClass();
            return false;
        },
        search: function (event, ui) {
//            if ($.inArray($(this).val().slice(-1), ['(', ')', '&', ' ', ',']) > -1) {
//                return false;
//            }
            $("#authors-ref-state-icon").removeClass().addClass("glyphicon glyphicon-refresh gly-spin");
        },
        response: function (event, ui) {
            if (ui.content.length === 0) {
                $("#authors-ref-state-icon").removeClass().addClass("glyphicon glyphicon-remove");
            } else {
                $("#authors-ref-state-icon").removeClass().addClass("glyphicon glyphicon-ok");
            }
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append('<a>' + item.label + ' [' + item.desc + '] ' + (item.remote ? '<span class="text-success">BHL' : '<span class="text-warning">Local') + '</span></a>')
                .appendTo(ul);
    };

    /*
     * autocomplete for taxon names
     */
    $("#taxon-name").autocomplete({
        source: prefix + "/requests/taxons.json", //taxons,
        minLength: 2,
        select: function (event, ui) {
            $("#taxon-name").val(ui.item.label);
            $("#taxon-id").val(ui.item.value);
            $("#taxon-ipni").val(ui.item.ipni);
            $("#taxon-name-state-icon").removeClass();
            return false;
        },
        search: function (event, ui) {
            $("#taxon-name-state-icon").removeClass().addClass("glyphicon glyphicon-refresh gly-spin");
        },
        response: function (event, ui) {
            if (ui.content.length === 0) {
                $("#taxon-name-state-icon").removeClass().addClass("glyphicon glyphicon-remove");
            } else {
                $("#taxon-name-state-icon").removeClass().addClass("glyphicon glyphicon-ok");
            }
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>" + item.label + ", " + item.desc + ", " + (item.ipni ? '<span class="text-success">IPNI' : '<span class="text-warning">Local') + "</span></a>")
                .appendTo(ul);
    };

    $("#los-publ").autocomplete({
        source: prefix + "/requests/publication.json",
        minLength: 2,
        select: function (event, ui) {
            $("#los-publ").val(ui.item.label);
            $("#los-publ-ipni").val(ui.item.value);
            $("#los-publication-state-icon").removeClass(); //hide glyphicon
            return false;
        },
        search: function (event, ui) {
            $("#los-publication-state-icon").removeClass().addClass("glyphicon glyphicon-refresh gly-spin"); //search began, show progress icon
        },
        response: function (event, ui) {
            if (ui.content.length === 0) { //search finished, show success or failure icon
                $("#los-publication-state-icon").removeClass().addClass("glyphicon glyphicon-remove");
            } else {
                $("#los-publication-state-icon").removeClass().addClass("glyphicon glyphicon-ok");
            }
        },
        type: 'json'
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>" + item.label + "<br />" + item.desc + "</a>")
                .appendTo(ul);
    };

    /*
     $("#los-authors").autocomplete({
     source: "/Lectotypf/requests/authors.json",
     //minLength: 2,
     select: function (event, ui) {
     //appendAuthor($("#reference-authors"), {id: ui.item.value, name: ui.item.label, remote: ui.item.remote});
     //TODO append author in result string
     appendAuthorTxt($("#los-authors-string"), $("los-authors-ids"), {id: ui.item.value, name: ui.item.label, remote: ui.item.remote});
     $(this).val('');
     $("#authors-ref-state-icon").removeClass();
     return false;
     },
     search: function (event, ui) {
     if ($.inArray($(this).val().slice(-1), ['(', ')', '&', ' ', ',']) > -1) { //we don't want to search for 'filling' characters
     return false;
     }
     $("#authors-ref-state-icon").removeClass().addClass("glyphicon glyphicon-refresh gly-spin");
     },
     response: function (event, ui) {
     if (ui.content.length === 0) {
     $("#authors-ref-state-icon").removeClass().addClass("glyphicon glyphicon-remove");
     } else {
     $("#authors-ref-state-icon").removeClass().addClass("glyphicon glyphicon-ok");
     }
     }
     }).autocomplete("instance")._renderItem = function (ul, item) {
     return $("<li>")
     .append('<a>' + item.label + ' [' + item.desc + '] ' + (item.remote ? '<span class="text-success">BHL' : '<span class="text-warning">Local') + '</span></a>')
     .appendTo(ul);
     };
     
     $("#los-authors").on('input', function (e) {
     if ($.inArray($(this).val().slice(-1), ['(', ')', '&', ' ', ',']) > -1) {
     $("#los-authors-string").append($(this).val().slice(-1));
     }
     });
     */

    /*
     $("#submit-person").click(function () {
     var $aj = sendAjax($("#AuthorAddForm").attr('action'), $("#AuthorAddForm").serialize());
     $aj.done(function (html) {
     var resp = JSON.parse(html);
     appendAuthor($("#reference-authors"), {id: resp.id, name: resp.std_name, ipni: false});
     });
     });
     */

    $("#submit-publication").click(function () {
        var $aj = sendAjax($("#PublicationAddForm").attr('action'), $("#PublicationAddForm").serialize());
        $aj.done(function (html) {
            console.log(html);
            $("#ref-publ").val(html.std_name);
            $("#ref-publ-id").val(html.id);
            $("#ref-publ-ipni").val(0);
            $("#modal-publication").modal('hide');
            clear($("#PublicationAddForm"));
            return false;
        });
    });
    
    $("#submit-person-bhl").click(function () {
        var $aj = sendAjax($("#AuthorBhlAddForm").attr('action'), $("#AuthorBhlAddForm").serialize());
        $aj.done(function (html) {
            appendAuthor($("#reference-authors"), {id: html.id, name: html.std_name, remote: false});
            $('#modal-person-bhl').modal('hide');
            clear($("#AuthorBhlAddForm"));
            return false;
        });
    });

    $("#submit-name").click(function (e) {
        var $aj = sendAjax($("#ListOfSpeciesAddForm").attr('action'), $("#ListOfSpeciesAddForm").serialize());
        $aj.done(function (html) {
            $("#taxon-name").val(html.std_name);
            $("#taxon-id").val(html.id);
            $("#taxon-ipni").val(0);
            $('#modal-taxon').modal('hide');
            clear($("#ListOfSpeciesAddForm"));
            return false;
        });
    });

    /**
     * Remove bhlauthor from list
     */
    $("#reference-authors").on("click", ".remove-ref-author", function (e) {
        e.preventDefault();
        //console.log($(this).parents("li.list-group-item"));
        $li = $(this).parents("li.list-group-item").remove();
        $("#reference-authors li.list-group-item").each(function (i) {
            $(this).find("span.badge").text(i + 1);
        });
    });

    $("#reference-authors").on("click", ".author-move-up", function (e) {
        e.preventDefault();
        $item = $(this).parents(".list-group-item");
        $before = $item.prev();
        $item.insertBefore($before);
        decrBadge($item);
        incrBadge($before);
        setItemNamePosition($item);
        setItemNamePosition($before);
        fixMoveBtns($("#reference-authors"));
        /*
         $item.find(".author-move-down").removeAttr("disabled");
         $before.find(".author-move-up").removeAttr("disabled");
         if ($before.is(":last-child")) {
         $before.find(".author-move-down").attr("disabled", "disabled");
         }
         if ($item.is(":first-child")) {
         $item.find(".author-move-up").attr("disabled", "disabled");
         }*/
    });


    $("#reference-authors").on("click", ".author-move-down", function (e) {
        e.preventDefault();
        $item = $(this).parents(".list-group-item");
        $after = $item.next();
        $item.insertAfter($after);
        incrBadge($item);
        decrBadge($after);
        setItemNamePosition($item);
        setItemNamePosition($after);
        fixMoveBtns($("#reference-authors"));
        /*
         $item.find(".author-move-up").removeAttr("disabled");
         $after.find(".author-move-down").removeAttr("disabled");
         if ($after.is(":first-child")) {
         $after.find(".author-move-up").attr("disabled", "disabled");
         }
         if ($item.is(":last-child")) {
         $item.find(".author-move-down").attr("disabled", "disabled");
         }
         */
    });
});
