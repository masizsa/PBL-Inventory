let total = 0;
let checkoutItems = [];
let sendListData = [];
const buttonLanjut = document.querySelector(
  ".custom--list-barang-dipilih-header > button"
);
buttonLanjut.disabled = true;

const lanjut = () => (checkoutItems.length ? true : false);
$(document).ready(function () {
  $("#sendDataPilihBarang").click(function () {
    $.ajax({
      type: "POST",
      url: "./formPeminjaman",
      contentType: "application/json",
      data: JSON.stringify({
        myData: checkoutItems,
      }),
      success: function (response) {
        window.location.href = "ajukanPeminjaman/formPeminjaman";
      },
      error: function () {
        alert("Error in AJAX request");
      },
    });
  });
});

const increment = (button, id) => {
  const max = parseInt(document.querySelector(`#tersedia${id}`).textContent);
  const minButton = document.querySelector(`#decButton${id}`);
  const target = document.querySelector(`#totalPilihBarang${id}`);

  let tmp = parseInt(target.value) + 1;

  button.disabled = max < tmp;
  minButton.disabled = false;
  target.value = tmp;
};

const decrement = (button, id) => {
  const max = parseInt(document.querySelector(`#tersedia${id}`).textContent);
  const plusButton = document.querySelector(`#incButton${id}`);
  const target = document.querySelector(`#totalPilihBarang${id}`);

  let tmp = parseInt(target.value) - 1;

  button.disabled = tmp <= 0;
  plusButton.disabled = false;
  target.value = tmp;
};

const scroollTo = (id, dependent = 0) => {
  const targetTop = document.querySelector(`#barang${id} > button`);
  const targetBottom = document.querySelector(`#indecrement${id}`);
  const boxCheckout = document.querySelector(`#indecrement${id} input`);
  let dependencies = dependent
    ? dependent
    : document.querySelector(`#totalPilihBarang${id}`).value;
  console.log("dependencies " + dependencies);

  if (dependencies > 0) {
    targetBottom.classList.add("show");
    targetTop.classList.add("show");
  } else {
    boxCheckout.value = 0;
    targetBottom.classList.remove("show");
    targetTop.classList.remove("show");
  }
};

const addToCheckout = (
  id,
  asalTersedia,
  asalTotalBarang,
  target1,
  target2,
  buttonMin,
  buttonPlus
) => {
  const kodeBarang = document.querySelector(`#kode${id}`);
  const namaBarang = document.querySelector(`#nama${id}`);
  const namaPengelola = document.querySelector(`#pengelola${id}`);
  const jumlahTersedia = document.querySelector(`#tersedia${id}`);
  let jumlahCheckout = parseInt(
    document.querySelector(`#totalPilihBarang${id}`).value
  );

  const objectIndex = checkoutItems.findIndex(
    (item) => item.kodeBarang == kodeBarang.textContent
  );

  if (objectIndex !== -1) {
    checkoutItems[objectIndex].jumlahCheckout += 1;
  } else {
    checkoutItems.push({
      kodeBarang: kodeBarang.textContent,
      namaBarang: namaBarang.textContent,
      namaPengelola: namaPengelola.textContent,
      jumlahCheckout,
      asalTersedia,
      asalTotalBarang,
      target1,
      target2,
      buttonMin,
      buttonPlus,
    });
  }

  if (lanjut()) {
    buttonLanjut.disabled = false;
    buttonLanjut.classList.add("active");
  } else {
    buttonLanjut.disabled = true;
    buttonLanjut.classList.remove("active");
  }
};

const minToCheckout = (id) => {
  const kodeBarang = document.querySelector(`#kode${id}`);
  const namaBarang = document.querySelector(`#nama${id}`);
  const namaPengelola = document.querySelector(`#pengelola${id}`);
  const jumlahTersedia = document.querySelector(`#tersedia${id}`);
  let jumlahCheckout = parseInt(
    document.querySelector(`#totalPilihBarang${id}`).value
  );

  const objectIndex = checkoutItems.findIndex(
    (item) => item.kodeBarang == kodeBarang.textContent
  );

  if (objectIndex !== -1) {
    checkoutItems[objectIndex].jumlahCheckout -= 1;
    if (checkoutItems[objectIndex].jumlahCheckout <= 0) {
      checkoutItems = checkoutItems.filter(
        (objek) => objek.jumlahCheckout !== 0
        );
        checkCard();
      }
    }

  if (lanjut()) {
    buttonLanjut.disabled = false;
    buttonLanjut.classList.add("active");
  } else {
    buttonLanjut.disabled = true;
    buttonLanjut.classList.remove("active");
  }
};

const deleteCheckoutItem = (idCard, kode, id) => {
  const card = document.querySelector(`#${idCard}`);
  const indentifier = [
    ...document.querySelectorAll(
      ".custom--table-pilih-barang tr td:first-child"
    ),
  ];
  const boxJumlahCheckout = document.querySelectorAll(
    ".custom--table-pilih-barang tr td input"
  );
  let jumlahCheckout = document.querySelector(`#totalPilihBarang${id}`);
  const minButton = document.querySelector(`#incButton${id}`);
  const plusButton = document.querySelector(`#decButton${id}`);

  const objectIndex = checkoutItems.findIndex(
    (item) => item.kodeBarang == kode
  );
  const tableIndex = indentifier.findIndex(
    (kodeBarang) => kodeBarang.textContent == kode
  );

  card.style.display = "none";
  if (objectIndex !== -1) {
    checkoutItems = checkoutItems.filter((objek) => objek.kodeBarang !== kode);
    boxJumlahCheckout[objectIndex].value = 0;
  }

  try {
    scroollTo(tableIndex + 1, boxJumlahCheckout[objectIndex].value);
  } catch (error) {
    return;
  }
  minButton.disabled = false;
  plusButton.disabled = false;
  if (lanjut()) {
    buttonLanjut.disabled = false;
    buttonLanjut.classList.add("active");
  } else {
    buttonLanjut.disabled = true;
    buttonLanjut.classList.remove("active");
  }
};

const renderCard = () => {
  const container = document.querySelector(".custom--list-barang-dipilih-body");
  container.innerHTML = "";
  let index = 1;
  checkoutItems.forEach((itemCard) => {
    if (itemCard.jumlahCheckout <= 0) {
      return;
    } else {
      container.innerHTML += `
                    <div class="custom--card-checkout" id="card${index}">
                            <div class="custom--card-checkout-left">
                                <div style="font-size: 12px;">${itemCard.kodeBarang}</div>
                                <div style="font-size: 20px; font-weight: 500;">${itemCard.namaBarang}</div>
                                <div style="font-size: 14px;">${itemCard.namaPengelola}</div>
                            </div>
                            <div class="custom--card-checkout-right">
                                <div style="font-size: 12px;">Jumlah</div>
                                <div style="font-size: 20px; font-weight: 600;" class="custom--total-card-qty">
                                    ${itemCard.jumlahCheckout}
                                </div>
                            </div>
                            <button  onclick = "deleteCheckoutItem('card${index}','${itemCard.kodeBarang}', '${index}')" class="custom--button-uncheckout"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 0C4.49 0 0 4.49 0 10C0 15.51 4.49 20 10 20C15.51 20 20 15.51 20 10C20 4.49 15.51 0 10 0ZM13.36 12.3C13.65 12.59 13.65 13.07 13.36 13.36C13.21 13.51 13.02 13.58 12.83 13.58C12.64 13.58 12.45 13.51 12.3 13.36L10 11.06L7.7 13.36C7.55 13.51 7.36 13.58 7.17 13.58C6.98 13.58 6.79 13.51 6.64 13.36C6.35 13.07 6.35 12.59 6.64 12.3L8.94 10L6.64 7.7C6.35 7.41 6.35 6.93 6.64 6.64C6.93 6.35 7.41 6.35 7.7 6.64L10 8.94L12.3 6.64C12.59 6.35 13.07 6.35 13.36 6.64C13.65 6.93 13.65 7.41 13.36 7.7L11.06 10L13.36 12.3Z" fill="#FCD106" />
                                </svg>
                            </button>
                        </div>
                    `;
      index++;
    }
  });
};

function checkCard() {
    let noBarangElement = document.getElementsByClassName('.no-barang');
    if (noBarangElement) {
      if (checkoutItems.length === 0) {
        noBarangElement.style.display = 'block'; // Tampilkan teks jika checkoutItems kosong
      } else {
        noBarangElement.style.color = 'white'; // Sembunyikan jika ada barang yang di-checkout
      }
    }
    console.log(noBarangElement);
    console.log(checkoutItems.length);
    console.log('pp');
}
