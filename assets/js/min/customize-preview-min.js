!function($){var e=$("#molecule-color-scheme-css"),c=wp.customize;e.length||(e=$("head").append('<style type="text/css" id="molecule-color-scheme-css" />').find("#molecule-color-scheme-css")),c("blogname",function(e){e.bind(function(e){$(".site-title a").text(e)})}),c("blogdescription",function(e){e.bind(function(e){$(".site-description").text(e)})}),c("background_image",function(e){e.bind(function(e){$("body").toggleClass("custom-background-image",""!==e)})}),c.bind("preview-ready",function(){c.preview.bind("update-color-scheme-css",function(c){e.html(c)})})}(jQuery);