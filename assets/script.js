$(function() {
  $('input[type="submit"]').hover(function() {
    $(this).animate({ marginLeft: 10 })
  }, function() {
    $(this).animate({ marginLeft: 0 })
  })

  $('.nav_main li a').hover(function() {
    $(this).animate({ top: 2 })
  }, function() {
    $(this).animate({ top: 0 })
  })
})
