$('#parent-employees > a').click(function() {
    subMenu = $('#parent-employees ul');
    toggleOpenClosed(subMenu);
});
$('#parent-professions > a').click(function() {
    subMenu = $('#parent-professions ul');
    toggleOpenClosed(subMenu);
});
$('#parent-themes > a').click(function() {
    subMenu = $('#parent-themes ul');
    toggleOpenClosed(subMenu);
});
$('#parent-subthemes > a').click(function() {
    subMenu = $('#parent-subthemes ul');
    toggleOpenClosed(subMenu);
});
$('#parent-courses > a').click(function() {
    subMenu = $('#parent-courses ul');
    toggleOpenClosed(subMenu);
});

function toggleOpenClosed(subMenu){
  if ($(subMenu).hasClass('open')) {
      $(subMenu).slideUp();
      $(subMenu).removeClass('open').addClass('closed');
  }else {
      $(subMenu).slideDown();
      $(subMenu).removeClass('closed').addClass('open');
  }
}