document.addEventListener("DOMContentLoaded", function() {
    getTime();

    const current = window.location.href;

    document.querySelectorAll("nav a").forEach(function(elem) {
        const linka = elem.getAttribute("href");
        
        if(linka === current) {
            elem.classList.add("bg-white", "text-black")
        } else {
            elem.classList.remove("bg-white", "text-black")
        }
    }); 
});

function getTime() {
    var today = new Date();
    var hours = today.getHours();
    var minutes = String(today.getMinutes()).padStart(2, '0');
    var seconds = String(today.getSeconds()).padStart(2, '0');
    var time = hours + ' : ' + minutes + ' : ' + seconds;

    document.getElementById("currentTime").textContent = time;

    setTimeout(function(){getTime()}, 1000);
}

function showModal(idModal) {
    var modal = document.getElementById(idModal);

    if(modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.classList.remove('animate-fadeOut');
        modal.classList.add('animate-fadeIn');
        event.preventDefault();
    }
}

function closeModal(idModal) {
    var modal = document.getElementById(idModal);
    console.log(modal)
    if(modal.classList.contains('flex')) {
        modal.classList.remove('flex')
        modal.classList.add('hidden');
    }
}

function closeNoti() {
    var flasher = document.getElementById('flasher')
    if(flasher) {
        flasher.remove()
    }
}

$(function() {
    $('.addNew').on('click', function() {
        $('#formLabel').html('Add New');
        $('.modal-footer button[type=submit]').html('Add New');
        $('#nik').val('');
        $('#name').val('');
        $('#email').val('');
        $('#pass').val('');
        $('#dateBorn').val('');
        $('#phoneNumber').val('');
        $('#addrss').val('');
        $('#roles').val('');
        $('#id').val('');
    });

    $('.changeModal').on('click', function() {
        $('#formLabel').html('Change');
        $('.modal-footer button[type=submit]').html('Change');

        const id = $(this).data('id');
        const type = $(this).data('type');

        $.ajax({
            url: `http://localhost/library-management-system/public/admin/${type}`,
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                if(type === 'getUser') {
                    $('.modal-body form').attr('action', 'http://localhost/library-management-system/public/admin/changeUser')
                    $('#nik').val(data.nik);
                    $('#name').val(data.fullname);
                    $('#dateBorn').val(data.tgl_lahir);
                    $('#phoneNumber').val(data.no_hp);
                    $('#addrss').val(data.alamat);
                    $('#id_user').val(data.id_user);
                } else if(type === 'getData') {
                    $('.modal-body form').attr('action', 'http://localhost/library-management-system/public/admin/change')
                    $('#name').val(data.nama);
                    $('#email').val(data.username);
                    $('#pass').val(data.pass);
                    $('#dateBorn').val(data.tgl_lahir);
                    $('#phoneNumber').val(data.telp);
                    $('#addrss').val(data.alamat);
                    $('#roles').val(data.jabatan);
                    $('#id_petugas').val(data.id_petugas);
                } else if(type === 'getBook')
                    $('.modal-body form').attr('action', 'http://localhost/library-management-system/public/admin/changeBook')
                    $('#title').val(data.judul);
                    $('#category').val(data.kategori);
                    $('#qty').val(data.qty);
                    $('#penulis').val(data.penulis);
                    $('#penerbit').val(data.penerbit);
                    $('#id').val(data.kode_buku);
            }
        });
    });

    $('.DeleteModal').on('click', function() {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const baseurl = `http://localhost/library-management-system/public/admin/${type}/`;
        $('#deleteBtn').attr('href', baseurl + id);
    })

    $('.detailModal').on('click', function() {
        const id = $(this).data('id');
        const type = $(this).data('type');
        $.ajax({
            url: `http://localhost/library-management-system/public/admin/${type}`,
            data: {id : id, type: type},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                if(type === 'getUser') {
                    $('#nameDetail').html("Name: " + data.fullname);
                    $('#dateBornDetail').html("Date of Birth: " + data.tgl_lahir);
                    $('#phoneNumberDetail').html("Number: " + data.no_hp);
                    $('#addrssDetail').html("Address: " + data.alamat);
                    $('#idDetail').html("NIK: " + data.nik);
                } else if(type === 'getData') {
                    $('#nameDetail').html("Name: " + data.nama);
                    $('#emailDetal').html("Email: " + data.username);
                    $('#dateBornDetail').html("Date of Birth: " + data.tgl_lahir);
                    $('#phoneNumberDetail').html("Number: " + data.telp);
                    $('#addrssDetail').html("Address" + data.alamat);
                    $('#rolesDetail').html("Role: " + data.jabatan);
                    $('#idDetail').html("Librarian ID: " + data.id_petugas);
                } else if(type === 'getBook') {
                    $('#titleDetail').html("Title: " + data.judul);
                    $('#categoryDetail').html("Category: " + data.kategori);
                    $('#qtyDetail').html("Qty: " + data.qty);
                    $('#penulisDetail').html("Writer: " + data.penulis);
                    $('#penerbitDetail').html("Publisher: " + data.penerbit);
                    $('#idDetail').html("Book Code: " + data.kode_buku);
                } else if(type === 'getBorrow') {
                    $('#titleDetail').html("Title: " + data.judul);
                    $('#fullnmDetail').html("Name: " + data.fullname);
                    $('#categoryDetail').html("Category: " + data.kategori);
                    $('#borrDetail').html("Borrowed: " + data.tnggl_pinjam);
                    $('#dueDetail').html("Due: " + data.bts_pinjam);
                    $('#penulisDetail').html("Writer: " + data.penulis);
                    $('#petugasDetail').html("Librarian: " + data.nama);
                    $('#idpinjamDetail').html("ID: " + data.id_pinjam);
                }
            }
        });
    });
});