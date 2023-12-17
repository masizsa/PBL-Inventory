let modal = document.getElementById("myModal");
let btn = document.getElementById("modal");
let span = document.getElementsByClassName("close")[0];

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
                    window.location.href = "../barangDipinjam";
                }
            }, 200);
        }, 2000);
    }, 10)
}

function hidePopup() {
    container.classList.remove('show');
    warning.classList.remove('show');
    success.classList.remove('show');
}

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

function updateFinishDate() {
  let startDate = new Date(document.getElementById("startDate").value);
  let inputState = document.getElementById("inputState");
  let selectedDays = parseInt(
    inputState.options[inputState.selectedIndex].value
  );

  if (!isNaN(startDate.getTime())) {
    let finishDate = new Date(startDate);
    finishDate.setDate(finishDate.getDate() + selectedDays);
    let yyyy = finishDate.getFullYear();
    let mm = ("0" + (finishDate.getMonth() + 1)).slice(-2);
    let dd = ("0" + finishDate.getDate()).slice(-2);
    document.getElementById("finishDate").value = yyyy + "-" + mm + "-" + dd;
  }
}

const backPage = () => {
  window.location.href = "../ajukanPeminjaman";
};

function createObjectsFromTable(tableId) {
  let dataObjects = [];

  let table = document.querySelector(tableId);
  let rowsHeader = table.querySelectorAll("thead")[0].querySelectorAll("th");
  let rows = table.querySelectorAll("tbody")[0].querySelectorAll("tr");

  for (let i = 0; i < rows.length; i++) {
    let rowData = {};
    let cells = rows[i].querySelectorAll("td");
    for (let j = 0; j < cells.length; j++) {
      let columnName = table
        .querySelectorAll("tbody")[0]
        .querySelectorAll("tr")[0]
        .querySelectorAll("td")
        [j].textContent.toLowerCase();
      rowData[rowsHeader[j].textContent] = cells[j].innerText;
    }
    dataObjects.push(rowData);
  }

  return dataObjects;
}

const dataSent = () => {
  const nama = document.querySelector("#nama").value;
  const nomor_identitas = document.querySelector("#nomor_identitas").value;
  const alasan = document.querySelector("#alasan").value;
  const startDate = document.querySelector("#startDate").value;
  const endDate = document.querySelector("#finishDate").value;

  const formValue = {
    nama,
    nomor_identitas,
    alasan,
    startDate,
    endDate,
  };
  const dataListBarang = createObjectsFromTable("#formPeminjaman");

  return {
    formValue,
    dataListBarang,
  };
};

const succesPopup = document.querySelector("#modalSuccess");
const errorPopup = document.querySelector("#modalError");
$(document).ready(function () {
  $("#modal").click(function () {
    // Menggunakan jQuery Ajax
    $.ajax({
      type: "POST", // Metode pengiriman data
      url: "processPinjam", // URL ke server PHP
      data: dataSent(), // Data yang akan dikirim
      contentType: "application/x-www-form-urlencoded",
      dataType: "json",
      success: function (res) {
        console.log(res);
        deleteCookie("myCookie");
        if (res.status == "success") {
          showPopup('customSuccess', "Berhasil mengajukan peminjaman!");
        } else if (res.status == "error") {
          showPopup('customWarning', "Form tidak boleh kosong!");
        } else if (res.status == "exceed") {
          showPopup('customWarning', "Kesempatan Peminjaman habis!");
          setTimeout(function() {
            window.location.href = "../barangDipinjam";
          }, 2200);
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
});

const redirectToBarangDipinjam = () => {
  window.location.href = "../barangDipinjam";
};

document.querySelector("#successModalButton").addEventListener("click", () => {
  redirectToBarangDipinjam();
});

function deleteCookie(name) {
  document.cookie =
    name +
    "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/PBL-Inventory/public;";
}
