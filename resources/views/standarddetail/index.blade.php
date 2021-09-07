@extends('layouts.admin_dynamic')

@section('content')
<div class="content-wrapper">
    @include('standarddetail.standarddetail')
</div>

@include('partials.gadds')
@endsection

@section('script')
<script>

    jQuery(document).delegate("a.edit-record", "click", function (e) {
            console.log('test')
            e.preventDefault();
            var content = jQuery("#edit_sample_table tr"),
            size = jQuery("#edit_tbl_posts >tbody >tr").length + 1,
            element = null,
            element = content.clone();
            element.attr("id", "rec-" + size);
            element.find(".delete-record").attr("data-id", size);
            element.appendTo("#edit_tbl_posts_body");
            element.find(".sn").html(size);
        });
        jQuery(document).delegate("a.delete-record-edit", "click", function (e) {
            e.preventDefault();
            var didConfirm = confirm("Are you sure You want to delete");
            if (didConfirm == true) {
            var id = jQuery(this).attr("data-id");
            var targetDiv = jQuery(this).attr("targetDiv");
            jQuery("#edit_rec-" + id).remove();
    
            //regnerate index number on table
            $("#edit_tbl_posts_body tr").each(function (index) {
                $(this)
                .find("span.sn")
                .html(index + 1);
            });
            return true;
            } else {
            return false;
            }
        });
    </script>
@endsection
