$(function () {
    $("#example1").DataTable();

});

const myForm = document.getElementById('form1');
myForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/admin/categories', {
        method: 'post',
        body: formData
    }).then((res) => res.json())
        .then((data) => console.log(data))
        .catch((error) => console.log(error));
})
