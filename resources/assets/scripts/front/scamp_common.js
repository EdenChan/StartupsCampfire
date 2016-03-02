function deleteResource(resource_id, resource_name) {
    delete_resource_form = $('#delete_' + resource_name + '_' + resource_id);
    delete_resource_form.submit();
}

$('li.dropdown').mouseover(function () {
    $(this).addClass('open');
}).mouseout(function () {
    $(this).removeClass('open');
});