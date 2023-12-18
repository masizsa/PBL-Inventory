const sectionPopUp = document.querySelector('.custom--container-add-item')

const addButton = document.querySelector(".custom--data-barang-table-wrapper--header button");
const editButton = document.querySelector(".custom--container-data-barang .editIcon");
const detailsButton = document.querySelector(".custom--container-data-barang .detailsIcon");
const deleteButton = document.querySelector(".custom--container-data-barang .deleteIcon");

const addPopup = document.querySelector('#add-item')
const editPopup = document.querySelector('#edit-item')
const detailsPopup = document.querySelector('#details-item')
const deletePopup = document.querySelector('#delete-item')

const closePopupButtons = document.querySelectorAll('.custom--close-button')
const closePopupDetails = document.querySelector('#custom--close-details')

closePopupButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault()
        const showPopup = document.querySelectorAll('.show');
        showPopup.forEach((popup) => {
            popup.classList.remove('show')
        })
    })
})

closePopupDetails.addEventListener('click', () => {
    const showPopup = document.querySelectorAll('.show');
    showPopup.forEach((popup) => {
        popup.classList.remove('show')
    })
})
const popupController = (button, popup) => {
    button.addEventListener('click', () => {
        sectionPopUp.classList.toggle('show');
        popup.classList.toggle('show');
    })
}

popupController(addButton, addPopup);
popupController(editButton, editPopup);
popupController(detailsButton, detailsPopup);
popupController(deleteButton, deletePopup);

const container = document.getElementById('customContainer');
const warning = document.getElementById('customWarning');
const success = document.getElementById('customSuccess');

function showPopup(id, text) {
    const popupText = document.querySelector(`#${id} .popupText`);

    popupText.textContent = text;
    container.classList.add('show');     
    setTimeout(() => {
        container.style.top = '1rem';
        const popupElement = id === 'customWarning' ? warning : success;
        popupElement.classList.add('show');

        setTimeout(() => {
            container.style.transition = 'top 0.3s ease';
            container.style.top = '-8.8rem';
            setTimeout(() => {
                hidePopup();
                if (id === 'customSuccess') {
                    location.reload();
                }
            }, 100);
        }, 2000);
    }, 10)
}

function hidePopup() {
    container.classList.remove('show');
    warning.classList.remove('show');
    success.classList.remove('show');
}

// HANDLE DELETE
function deleteItem(id_barang) {
    console.log("Delete Item ID: " + id_barang);

    const modal = document.getElementById('delete-item');
    const closeButton = modal.querySelector('.custom--close-button');
    const deleteButton = modal.querySelector('.custom--delete-btn');

    sectionPopUp.classList.add('show');
    modal.classList.add('show');
    closeButton.onclick = function () {
        modal.classList.remove('show');
    };

    deleteButton.onclick = function () {
        fetch(`../public/dataBarang/deleteBarang/${id_barang}`, {
                method: 'DELETE',
            })
            .then(response => response.json())
            .then(response => {
                if (response.status === 'success') {
                    console.log("Item deleted successfully");
                    showPopup('customSuccess', 'Barang berhasil dihapus')
                } else if (response.status === 'warning') {
                    console.log("Item cannot be deleted");
                    showPopup('customWarning', 'Barang sedang dipinjam');
                } else {
                    console.error("Failed to delete item");
                }
            })
            .catch(error => {
                console.error("Error during deletion:", error);
            });
        sectionPopUp.classList.remove('show');
        modal.classList.remove('show');
    };
}

function editItem(id_barang) {
    console.log("Edit Item ID: " + id_barang);
    sectionPopUp.classList.add('show');
    editPopup.classList.add('show');

    fetch(`../public/dataBarang/getBarangDetails/${id_barang}`)
        .then(response => response.json())
        .then(data => {
            console.log("Data received:", data);
            document.getElementById('kode_barang_edit').value = data.id_barang;
            document.getElementById('nama_barang_edit').value = data.nama_barang;
            document.getElementById('asal_edit').value = data.asal;
            document.getElementById('jumlah_edit').value = data.jumlah_tersedia;
            document.getElementById('jumlah_pemeliharaan_edit').value = data.jml_pemeliharaan;
            document.getElementById('keterangan_edit').innerText = data.kondisi_barang;
        })
        .catch(error => {
            console.error("Error fetching details:", error);
        });
}
// HANDLE EDIT SUBMIT
function handleEditSubmit(event) {
    event.preventDefault();
    const id_barang = document.getElementById('kode_barang_edit').value;
    const nama_barang = document.getElementById('nama_barang_edit').value;
    const asal = document.getElementById('asal_edit').value;
    const jumlah = document.getElementById('jumlah_edit').value;
    const jumlah_pemeliharaan = document.getElementById('jumlah_pemeliharaan_edit').value;
    const keterangan = document.getElementById('keterangan_edit').value;

    fetch(`../public/dataBarang/updateItem`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `kode_barang=${id_barang}&nama_barang=${nama_barang}&asal=${asal}&jumlah=${jumlah}&jumlah_pemeliharaan=${jumlah_pemeliharaan}&keterangan=${keterangan}`,
    })
    .then(response => response.json())
    .then(response => {
        console.log(response);
        if (response.status === 'warning') {
            console.error("Failed to update item. Error message:", response.message);
            showPopup('customWarning', 'Jumlah pemeliharaan melebihi tersedia')
        } else if (response.status === 'success') {
            console.log("Item updated successfully");
            showPopup('customSuccess', 'Data barang berhasil diubah')
        }
    })
    .catch(error => {
        console.error("Error updating item:", error);
    })
    sectionPopUp.classList.remove('show');
    editPopup.classList.remove('show');
}
$('#editBarangForm').submit(handleAddSubmit);

const submitEditButton = document.getElementById('submit-edit');
submitEditButton.addEventListener('click', handleEditSubmit);
// END OF HANDLE EDIT SUBMIT

// HANDLE ADD SUBMIT
function handleAddSubmit(event) {
    event.preventDefault();

    const kode_barang = $('#kode_barang').val();
    const nama_barang = $('#nama_barang').val();
    const asal = $('#asal').val();
    const jumlah = $('#jumlah').val();
    const keterangan = $('#keterangan').val();

    $.ajax({
        type: 'POST',
        url: '../public/dataBarang/addBarang',
        data: {
            kode_barang: kode_barang,
            nama_barang: nama_barang,
            asal: asal,
            jumlah: jumlah,
            keterangan: keterangan
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status === 'empty') {
                showPopup('customWarning', 'Form tidak boleh kosong')
            } else if (response.status === 'duplicate') {
                showPopup('customWarning', 'Kode barang sudah ada')
            } else if (response.status === 'success') {
                showPopup('customSuccess', 'Barang berhasil ditambahkan')
                sectionPopUp.classList.remove('show');
                addPopup.classList.remove('show');
            } else {
                console.error('Failed to add item');
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            // alert('Error adding item. Please try again.');
        }
    }
    );
}
$('#addBarangForm').submit(handleAddSubmit);

const submitAddButton = document.getElementById('submit-add');
submitAddButton.addEventListener('click', handleAddSubmit);
// END OF HANDLE ADD SUBMIT

// HANDLE DETAILS
function showDetails(id_barang) {
    console.log("Show Details for Item ID: " + id_barang);

    sectionPopUp.classList.add('show');
    detailsPopup.classList.add('show');

    fetch(`../public/dataBarang/getBarangDetails/${id_barang}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('kode_barang_detail').value = data.id_barang;
            document.getElementById('nama_barang_detail').value = data.nama_barang;
            const tersedia = parseInt(document.getElementById('tersedia_detail').value);
            const dipinjam = parseInt(document.getElementById('dipinjam_detail').value);
            const pemeliharaan = parseInt(document.getElementById('pemeliharaan_detail').value);
            const jumlah = tersedia + dipinjam + pemeliharaan;
            document.getElementById('jumlah_detail').value = jumlah;
            document.getElementById('tersedia_detail').value = data.jumlah_tersedia;
            document.getElementById('dipinjam_detail').value = data.jumlah_dipinjam;
            document.getElementById('pemeliharaan_detail').value = data.jml_pemeliharaan;
            document.getElementById('keterangan-detail').innerText = data.kondisi_barang;
            console.log(data.kondisi_barang);
        })
        .catch(error => {
            console.error("Error fetching details:", error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    var editIcons = document.querySelectorAll(".editIcon");
    editIcons.forEach(function (editIcon) {
        editIcon.addEventListener("click", function () {
            var id_barang = editIcon.closest("tr").querySelector("[id^='kode']").innerText;
            editItem(id_barang);
        });
    });

    var detailsIcons = document.querySelectorAll(".detailsIcon");
    detailsIcons.forEach(function (detailsIcon) {
        detailsIcon.addEventListener("click", function () {
            var id_barang = detailsIcon.closest("tr").querySelector("[id^='kode']").innerText;
            showDetails(id_barang);
        });
    });

    var deleteIcons = document.querySelectorAll(".deleteIcon");
    deleteIcons.forEach(function (deleteIcon) {
        deleteIcon.addEventListener("click", function () {
            var id_barang = deleteIcon.closest("tr").querySelector("[id^='kode']").innerText;
            deleteItem(id_barang);
        });
    });
});