$(document).ready(function () {
  // Add smooth scrolling to all links
  $("a").on('click', function (event) {

    // Make sure this.hash has a value before overriding default behavior
    if ("" !== this.hash) {
      // Prevent default anchor click behavior
      event.preventDefault()

      // Store hash
      var hash = this.hash

      let time = 1000
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, time, function () {

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash
      })
    }
  })
})
