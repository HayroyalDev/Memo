$(document).on('click','.edit-user-modal',function() {
    $('#footer_action_button').text('Update');
    $('#edituser').text('Update');
    //$('#footer_action_button').addClass('glyphicon-check');
    //$('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    //$('.actionBtn').removeClass('btn-danger');
    //$('.actionBtn').addClass('edit');
    $('.modal-title').text('Edit User');
    $('.deleteuser').hide();
    $('.form-horizontal').show();
    $('#post_type').val(0);
    $('#uid').val($(this).data('id'));
    $('#sid').val($(this).data('id'));
    $('#email').val($(this).data('email'));
    $('#username').val($(this).data('username'));
    $('#role').val($(this).data('is_admin'));
    $('#status').val($(this).data('is_active'));
    $('#UserModal').modal('show');
});

$(document).on('click','.add-user-modal',function() {
    $('#footer_action_button').text('Update');
    $('#edituser').text('Add');
    $('#result_footer_action_button').addClass('glyphicon-plus');
    $('#result_footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Add User');
    $('.deleteuser').hide();
    $('.form-horizontal').show();
    $('#post_type').val(1);
    $('.hide_for_add').hide();
    $('#email').val($(this).data('email'));
    $('#username').val($(this).data('username'));
    $('#role').val($(this).data('is_admin'));
    $('#status').val($(this).data('is_active'));
    $('#UserModal').modal('show');
});

$(document).on('click','.add-info',function() {
    e.preventDefault();
    $('#footer_action_button').text('Add');
    $('#edituser').text('Add');
    $('#result_footer_action_button').addClass('glyphicon-plus');
    $('#result_footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Add Information');
    $('.deleteuser').hide();
    $('.form-horizontal').show();
    $('#post_type').val(1);
    $('.hide_for_add').hide();
    //$('#email').val($(this).data('email'));
    //$('#username').val($(this).data('username'));
    //$('#role').val($(this).data('is_admin'));
    //$('#status').val($(this).data('is_active'));
    $('#NewsModal').modal('show');
});

