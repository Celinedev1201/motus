const guessForm = document.getElementById("guess-form");

if (guessForm) {
  guessForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(guessForm);

    const response = await fetch("/guess", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        guess: formData.get("guess"),
      }),
    });

    const data = await response.json();

    document.getElementById("guess-message").textContent = data.message;

    window.location.reload();
  });
}
