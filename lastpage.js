const user = document.getElementById("name");
const savetotalscore = document.getElementById("savescore");
const totalscore = document.getElementById("TotalScore");
const finalscore = localStorage.getItem('score') || 0;

totalscore.innerText = finalscore;

user.addEventListener("input", () => {
    savetotalscore.disabled = user.value.trim() === "";
});

savetotalscore.addEventListener("click", (event) => {
    event.preventDefault();

    const userName = user.value.trim();

    if (userName) {
        const scores = JSON.parse(localStorage.getItem('scores')) || [];
        scores.push({ name: userName, score: finalscore });
        localStorage.setItem('scores', JSON.stringify(scores));

        alert("Score saved successfully!");
        user.value = '';
    } else {
        alert("Please enter your name.");
    }
});
