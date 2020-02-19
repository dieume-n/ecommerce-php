import Swal from "sweetalert2";

$(function () {
    $("#example1").DataTable({
        ordering: false
    });

    $('.update-category').on('click', function (e) {
        e.preventDefault();
        let token = $(this).data('token');
        let id = $(this).attr('id');
        let name = $('#category-' + id).val();
        const formData = new FormData();
        formData.append('name', name);
        formData.append('token', token);
        fetch('/admin/categories/' + id + '/edit', {
            method: 'post',
            body: formData
        }).then(res => res.json())
            .then(data => {
                if (data.status === 422) {
                    let name_category = document.getElementById('category-' + id);
                    name_category.classList.add('is-invalid');
                    let error_message = document.getElementById('error-' + id);
                    error_message.innerHTML = data.errors.name;
                } else {
                    $('#hide-edit-' + id).click();
                    Swal.fire({
                        icon: 'success',
                        title: 'category Updated'
                    }).then(function () {
                        location.reload();
                    });
                }

            }).catch(error => console.error(error));
    });

    $('.create-category').on('click', function (e) {
        e.preventDefault();
        let token = $(this).data('token');
        let name = $('#category-name').val();
        const formData = new FormData();
        formData.append('name', name);
        formData.append('token', token);
        fetch('/admin/categories', {
            method: 'post',
            body: formData
        }).then(res => res.json())
            .then(data => {
                if (data.status === 422) {
                    let name_category = document.getElementById('category-name');
                    name_category.classList.add('is-invalid');
                    let error_message = document.getElementById('error-message');
                    error_message.innerHTML = data.errors.name;
                } else {
                    $('#hide-modal').click();
                    Swal.fire({
                        icon: 'success',
                        title: 'category Created'
                    }).then(function () {
                        location.reload();
                    });
                }

            })
    });
});