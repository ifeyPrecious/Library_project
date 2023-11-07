function confirmDelete(bookId) {
    const confirmMessage = `Are you sure you want to delete book with ID ${bookId}?`;

    if (confirm(confirmMessage)) {
        // If the user confirms, proceed with the delete action
        window.location.href = `delete_books.php?id=${bookId}`;
    }
}
