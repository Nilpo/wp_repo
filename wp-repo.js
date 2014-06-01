$(window).load(function() {
  $('.wp_repo').each(function() {
    //$(this).attr('data-name');    //legacy
    data = {
      user:   $(this).data('user'),
      name:   $(this).data('name')
    }
    
    branch = $(this).data('branch');
    if (branch !== undefined) {
      data.branch = branch;
    }
    
    $(this).repo(data);
  });
});
