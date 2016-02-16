/**
 * Created by mmk2410 on 2016-02-16.
 *
 * JavaScript for the ajax request to generate a atom feed
 *
 * Copyright (c) 2016 by mmk2410
 * License: MIT License
 */


function main() {
  // listener and function for calling the ajax request to create the
  // requested atom feed
  $("#generate_atom").click(function () {
    var selectedBlog = $("#generate_atom_blog").val();
    $.get("feed/index.php", {
      blog: selectedBlog
    }, function (data) {
      if (data == "0") {
        alert("Atom feed sucessfully created.");
      } else {
        alert("Failed to create atom feed.");
      }
    });
  });
}

$(document).ready(main());
