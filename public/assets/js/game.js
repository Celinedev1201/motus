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

    if (!data.success) {
      alert(data.message);
      return;
    }

    document.getElementById("guess-message").textContent = data.message;

    if (data.isWin) {
      alert("Bravo ! Vous avez trouvé le mot !");
      window.location.reload();
      return;
    }

    if (data.isLose) {
      alert("Perdu ! Le mot était : " + data.secretWord);
      window.location.reload();
      return;
    }

    window.location.reload();
  });
}
