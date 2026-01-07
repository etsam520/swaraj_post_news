function delete_alert(item, message) {
    event.preventDefault();  // Prevent the default anchor action (e.g., navigating to href)

    Swal.fire({
        title: 'Are you sure  ',
        text: message,
        icon: 'warning',  // Correct SweetAlert syntax
        showCancelButton: true,
        cancelButtonColor: 'default',
        confirmButtonColor: '#FC6A57',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        reverseButtons: true
    }).then((result) => {
if (result.isConfirmed) {
    // Create a dynamic form
    const form = document.createElement('form');
    form.method = 'POST'; // Use POST for compatibility
    form.action = item.getAttribute('href'); // Set the URL from the href attribute


    // Add a hidden _method input to simulate DELETE
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    form.appendChild(methodInput);

    // Add a CSRF token if required (for Laravel or other frameworks)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
    }

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
}
});
}

function confirm_alert(item, message) {
    event.preventDefault();  // Prevent the default anchor action (e.g., navigating to href)
    Swal.fire({
        title: 'Are you sure  ',
        text: message,
        icon: 'inof',  // Correct SweetAlert syntax
        showCancelButton: true,
        cancelButtonColor: 'default',
        confirmButtonColor: '#FC6A57',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        reverseButtons: true
    }).then((result) => {
if (result.isConfirmed) {
    location.href = item.getAttribute('href'); // Set the URL from the href attribute
}
});
}



