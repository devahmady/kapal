document.addEventListener('click', function (event) {
  var target = event.target;
  var button = target.closest('.btn-delete');

  if (button) {
    event.preventDefault();
    var id = button.getAttribute('data-id');
    var form = $('#form-delete-' + id); // Menggunakan jQuery untuk mengambil elemen

    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data ini akan dihapus secara permanen.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: form.attr('action'),
          type: 'POST',
          data: form.serialize(), // Menggunakan jQuery serialize
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          success: function (response) {
            Swal.fire(
              'Dihapus!',
              'Data telah dihapus.',
              'success'
            ).then(function () {
              window.location.reload(); // Reload halaman setelah sukses
            });
          },
          error: function (response) {
            Swal.fire(
              'Gagal!',
              'Terjadi kesalahan saat menghapus data.',
              'error'
            );
          }
        });
      }
    });
  }
});


$(document).ready(function() {
  $('.form-select').on('change', function() {
      var selectElement = $(this);
      var status = selectElement.val();
      var id = selectElement.data('id');
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      if (!id) {
          console.error('Data-id attribute is missing.');
          return;
      }

      $.ajax({
          url: `/manage/pemesanan/${id}/status`,
          method: 'PUT',
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          contentType: 'application/json',
          data: JSON.stringify({
              status: status
          }),
          success: function(data) {
              if (data.success) {
                  var statusElement = $('#status-' + id);
                  if (statusElement.length) {
                      statusElement.text(status.charAt(0).toUpperCase() + status.slice(1));
                      statusElement.attr('class', 'badge option-' + status + ' shadow-md dark:group-hover:bg-transparent');
                  } else {
                      console.error('Status element not found.');
                  }
              } else {
                  alert('Failed to update status');
              }
          },
          error: function(xhr) {
              console.error('Error:', xhr.responseText);
              alert('Failed to update status');
          }
      });
  });
});