$(document).on('click', '#btn-delete-category', function(e) {
  e.preventDefault();
  var link = $(this).attr('href');

  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'main-btn success-btn rounded-md btn-sm btn-hover ml-20',
    cancelButton: 'main-btn danger-btn rounded-md btn-sm btn-hover'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "If you delete a category, the product will also be deleted!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location = link;
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'This Category is safe :)',
      'error'
    )
  }
})
})

$(document).on('click', '#btn-delete-product', function(e) {
  e.preventDefault();
  var link = $(this).attr('href');

  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'main-btn success-btn rounded-md btn-sm btn-hover ml-20',
    cancelButton: 'main-btn danger-btn rounded-md btn-sm btn-hover'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "If you delete a product, the invoice will also be deleted!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location = link;
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'This Product is safe :)',
      'error'
    )
  }
})
})

$(document).on('click', '#btn-delete-customer', function(e) {
  e.preventDefault();
  var link = $(this).attr('href');

  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'main-btn success-btn rounded-md btn-sm btn-hover ml-20',
    cancelButton: 'main-btn danger-btn rounded-md btn-sm btn-hover'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "If you delete an customer, the invoice will also be deleted!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location = link;
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'This Customer is safe :)',
      'error'
    )
  }
})
})