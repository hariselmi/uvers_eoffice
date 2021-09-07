$(document).ready(function () {
    jQuery(document).delegate("a.add-record", "click", function (e) {
        console.log('tesst')
        e.preventDefault();
        var content = jQuery("#sample_table tr"),
        size = jQuery("#tbl_posts >tbody >tr").length + 1,
        element = null,
        element = content.clone();
        element.attr("id", "rec-" + size);
        element.find(".delete-record").attr("data-id", size);
        element.appendTo("#tbl_posts_body");
        element.find(".sn").html(size);
    });
    jQuery(document).delegate("a.delete-record", "click", function (e) {
        e.preventDefault();
        var didConfirm = confirm("Are you sure You want to delete");
        if (didConfirm == true) {
        var id = jQuery(this).attr("data-id");
        console.log(id, id);
        var targetDiv = jQuery(this).attr("targetDiv");
        jQuery("#rec-" + id).remove();

        //regnerate index number on table
        $("#tbl_posts_body tr").each(function (index) {
            $(this)
            .find("span.sn")
            .html(index + 1);
        });
        return true;
        } else {
        return false;
        }
    });
});
