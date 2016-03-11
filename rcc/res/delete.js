/**
 * JavaScript for the ajax request to delete blog post
 *
 * Copyright (c) 2016 by mmk2410
 * License: MIT License
 */

function main() {

    // listener and function for recieving the posts of the selected blogs
    $("#delete_get_posts").click(function () {

        var selectedBlog = $("#delete_selected_blog").val();

        $.get("res/get_posts.php", {
            blog: selectedBlog
        }, function (data) {

            $("#delete_select_post").remove();
            $("#delete_select_post_info").remove();
            $("#delete_post_button").remove();
            $("#delete_get_posts").after("<p id='delete_select_post'></p>");
            $("#delete_get_posts").after(
                "<p id='delete_select_post_info'>" +
                "Now select the post you want to delete. " +
                "Remember that once a post is deleted it can't be restored.</p>"
            );
            $("#delete_select_post").append(
                "<select id='delete_selected_post'></select>"
            );

            $.each($.parseJSON(data), function (index, value) {
                var post = value.substring(0, value.length - 3);
                $("#delete_selected_post").append(
                    "<option value='" + post + "'>" + post + "</option>"
                );
            });

            $("#delete_select_post").after(
                "<a class='button' id='delete_post_button' " +
                "onclick='deletePostButton()'>DELETE POST</a>"
            );
        });
    });

}

/**
 * Delete the selected posts
 */
function deletePostButton() {

    var selectedBlog = $("#delete_selected_blog").val();
    var selectedPost = $("#delete_selected_post").val();

    $.get("res/delete_post.php", {
        blog: selectedBlog,
        post: selectedPost
    }, function (data) {

        $("#delete_select_post").remove();
        $("#delete_select_post_info").remove();
        $("#delete_post_button").remove();
        if (data == "901") {
            alert("ERROR 901: No post as get argument given.");
        } else if (data == "921") {
            alert("ERROR 921: No post with given argument available.");
        } else if (data == "941") {
            alert("ERROR 941: No blog as get argument given");
        } else if (data == "961") {
            alert(
                "ERROR 961: Error while deleting the file. Check if the" +
                "web server has the permission to do so."
            );
        } else if (data == "0") {
            alert("Post successfully deleted.");
        }
    });

}

$(document).ready(main());
