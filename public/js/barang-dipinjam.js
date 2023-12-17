function updateCountdown(returnDates) {
  const now = new Date();

  let closestReturnDate = new Date(returnDates[0]);

  returnDates.forEach((date) => {
    const returnDate = new Date(date);
    if (
      returnDate > now &&
      (returnDate < closestReturnDate || closestReturnDate <= now)
    ) {
      closestReturnDate = returnDate;
    }
  });

  const timeDifference = closestReturnDate - now;

  if (timeDifference <= 0) {
    document.getElementById("days").innerHTML = "Expired";
    return;
  }

  const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
  const hours = Math.floor(
    (timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
  );
  const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
  const monthLabel = closestReturnDate.toLocaleString("id-ID", {
    month: "short",
  });

  if (timeDifference >= 0) {
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("month-label").innerHTML = monthLabel;
    document.getElementById("month").innerHTML = closestReturnDate.getDate();
  }
}

updateCountdown(returnDatesFromDatabase);

setInterval(() => {
  updateCountdown(returnDatesFromDatabase);
}, 1000);
