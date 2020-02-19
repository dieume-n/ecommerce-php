import Swal from "sweetalert2";

$(function () {
    $("#example1").DataTable({
        ordering: false
    });

});

const myForm = document.getElementById('form1');
myForm.addEventListener('submit', function (e) {
    e.preventDefault();
    let name = $('#category-name').val();
    let token = $('#category-token').val();
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
                    title: 'category created'
                }).then(function () {
                    location.reload();
                });
            }
        }).catch(function (error, data) {

            console.log(error);
        });
})
