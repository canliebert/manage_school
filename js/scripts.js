/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */

// Scripts
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});


$(function() {
    // Tangani event klik untuk tombol edit
    $('#edit').on('click', function() {
        $('#formModalLabel').html('Ubah data');
        $('.modal-footer button[type=submit]').html('Ubah data');
        $('.modal-body form').attr('action', 'http://localhost/belajar/phpmvc/public/blog/ubah');

        const id = $(this).data('id');

        // console.log('oke');

        $.ajax({
            url: 'http://localhost/belajar/phpmvc/public/blog/get',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data); // Tambahkan log ini untuk melihat respons data
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#kelas').val(data.kelas);
                $('#alamat').val(data.alamat);
                $('#jurusan').val(data.jurusan);
            }
        });
    });

    // Tangani event klik untuk tombol tambah
    $('.tambah').on('click', function() {
        $('#formModalLabel').html('Tambah data');
        $('.modal-footer button[type=submit]').html('Tambah data');
        $('.modal-body form').attr('action', 'pr_siswa.php?param=create');
        $('#id').val('');
        $('#nama').val('');
        $('#kelas').val('');
        $('#alamat').val('');
        $('#jurusan').val('');
    });
});