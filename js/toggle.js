jQuery(".toggle .toggle-title").hasClass("active") &&
  jQuery(".toggle .toggle-title.active")
    .closest(".toggle")
    .find(".toggle-inner")
    .show(),
  jQuery(".toggle .toggle-title").click(function() {
    jQuery(this).hasClass("active")
      ? jQuery(this)
          .removeClass("active")
          .closest(".toggle")
          .find(".toggle-inner")
          .slideUp(400)
      : jQuery(this)
          .addClass("active")
          .closest(".toggle")
          .find(".toggle-inner")
          .slideDown(400);
  });

$(".nav-link, .navbar-brand").click(function() {
  var sectionTo = $(this).attr("href");
  $("html, body").animate(
    {
      scrollTop: $(sectionTo).offset().top
    },
    1000
  );
});

$(function() {
  $(".show-code > a").on("click", function(e) {
    e.preventDefault();
    $(this)
      .parent()
      .find(".code")
      .slideDown(100);
    $(this).hide();
  });

  $("#header-contact-link").click(function(e) {
    e.preventDefault();
    $("#header-contact").toggleClass("contact-activated");
  });
});
