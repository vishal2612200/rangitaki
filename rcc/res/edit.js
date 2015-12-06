/**
 * Created by mmk2410 on 12/6/15.
 *
 * JavaScript for the functionality to delete blogs
 */

function main() {

    // listener and function for recieving the posts of the selected blogs
    $("#edit_get_posts").click(function () {
        var selectedBlog = $("#edit_selected_blog").val();
        $.get("res/get_posts.php", {
            blog: selectedBlog
        }, function (data) {
            $("#edit_select_post").remove();
            $("#edit_select_post_info").remove();
            $("#edit_post_button").remove();
            $("#edit_get_posts").after("<p id='edit_select_post'></p>");
            $("#edit_get_posts").after("<p id='edit_select_post_info'>Now select the post you want to edit.</p>");
            $("#edit_select_post").append("<select id='edit_selected_post'></select>");
            $.each($.parseJSON(data), function (index, value) {
                var post = value.substring(0, value.length - 3);
                $("#edit_selected_post").append("<option value='" + post + "'>" + post + "</option>");
            });
            $("#edit_select_post").after("<a class='button' id='edit_post_button' " +
                "onclick='editPostButton()'>EDIT POST</a>")
        });
    });

    $("#save_changes").click(function () {
        var postTitle = $("#title").val();
        var postDate = $("#date").val();
        var postAuthor = $("#author").val();
        var postTags = $("#tags").val();
        var postText = $("#text").val();

        var file = "../../articles/" + getVariables['blog'] + "/" + getVariables['post'] + ".md";
        console.log(file);

        $.post("../res/save.php", {
            title: postTitle,
            date: postDate,
            author: postAuthor,
            tags: postTags,
            text: postText,
            file: file
        }, function (data) {
            if (data == "0") {
                alert("File successfully changed.");
                window.open("../");
            } else if (data == "1") {
                alert("Error while saving the changes.");
            } else if (data == "-1") {
                alert("file");
            }
        });
    });
}

/**
 * Delete the selected posts
 */
function editPostButton() {

    var selectedBlog = $("#edit_selected_blog").val();
    var selectedPost = $("#edit_selected_post").val();
    var href = "./edit/?blog=" + selectedBlog + "&post=" + selectedPost;
    window.open(href);

}

$(document).ready(main());