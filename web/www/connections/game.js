let selectedWords = [];
const gameData = {
    guessCount: 0,
    numberOfGames: 0,
    numberOfWins: 0,
    winStreak: 0,
    averageGuesses: 0,
    totalGuesses: 0,
    connections: {},
    prevGuesses: [],
    categoriesGuessed: 0,
    removedWords: [],
}

document.addEventListener('DOMContentLoaded', function () {
    const gameDataLocal = JSON.parse(localStorage.getItem('gameData'));
    console.log(gameDataLocal);
    if (gameDataLocal) {
        const savedGame = gameDataLocal['connections'];
        gameData.guessCount = gameDataLocal['guessCount'];
        gameData.numberOfGames = gameDataLocal['numberOfGames'];
        gameData.numberOfWins = gameDataLocal['numberOfWins'];
        gameData.winStreak = gameDataLocal['winStreak'];
        gameData.averageGuesses = gameDataLocal['averageGuesses'];
        gameData.totalGuesses = gameDataLocal['totalGuesses'];
        gameData.prevGuesses = gameDataLocal['prevGuesses'] || [];
        gameData.categoriesGuessed = gameDataLocal['categoriesGuessed'];
        gameData.removedWords = gameDataLocal['removedWords'] || [];
        if (savedGame) {
            setupGame(savedGame);
        } else {
            startNewGame();
        }
    } else {
        startNewGame();
    }
    renderPrevGuesses();
    document.getElementById('startNewGame').addEventListener('click', newGame);
    document.getElementById('submitSelection').addEventListener('click', submitSelection);
    document.getElementById('shuffle').addEventListener('click', shuffle);
    document.getElementById('delete').addEventListener('click', deleteStorage);
});

function newGame() {
    document.getElementById("shuffle").style.display = 'inline';
    document.getElementById("submitSelection").style.display = 'inline';
    let prevAnswersDiv = document.getElementById("previousAnswers");
    prevAnswersDiv.innerHTML = "";
    gameData.removedWords = [];
    gameData.guessCount = 0;
    if (gameData.categoriesGuessed === 4) {
        gameData.categoriesGuessed = 0;
        startNewGame();
    } else {
        gameData['winStreak'] = 0;
        gameData['numberOfGames']++;
        gameData['totalGuesses'] = 0;
        gameData['averageGuesses'] = 0;
        updateStatistics();
        localStorage.setItem('gameData', JSON.stringify(gameData));
        gameData.categoriesGuessed = 0;
        startNewGame();
    }
}

function deleteStorage() {
    document.getElementById("shuffle").style.display = 'inline';
    document.getElementById("submitSelection").style.display = 'inline';
    localStorage.removeItem('gameData');
    gameData.averageGuesses = 0;
    gameData.connections = {};
    gameData.guessCount = 0;
    gameData.numberOfGames = 0;
    gameData.numberOfWins = 0;
    gameData.totalGuesses = 0;
    gameData.winStreak = 0;
    selectedWords = [];
    gameData.prevGuesses = [];
    gameData.categoriesGuessed = 0;
    gameData.removedWords = [];
    let prevAnswersDiv = document.getElementById("previousAnswers");
    prevAnswersDiv.innerHTML = "";
    updateStatistics();
    startNewGame();
}

function shuffle() {
    let words = [];
    document.querySelectorAll('.cell').forEach(cell => {
        if (cell.style.display !== 'none') {
            const word = cell.textContent.trim();
            if (!gameData.removedWords.includes(word)) {
                words.push(word);
            }
        }
    });
    words.sort(() => Math.random() - 0.5)
    const gameBoard = document.getElementById('gameBoard');
    gameBoard.innerHTML = '';
    for (let i = 0; i < words.length; i++) {
        const cell = document.createElement('div');
        cell.classList.add('cell');
        cell.textContent = words[i];
        cell.addEventListener('click', function () {
            if (!this.classList.contains('selected')) {
                if (selectedWords.length === 4) {
                    return;
                }
                this.classList.add('selected');
                this.style.backgroundColor = 'lightgreen';
                selectedWords.push(this.textContent.trim());
            } else {
                this.classList.remove('selected');
                this.style.backgroundColor = '';
                const wordIndex = selectedWords.indexOf(this.textContent.trim());
                if (wordIndex > -1) {
                    selectedWords.splice(wordIndex, 1);
                }
            }
        });
        gameBoard.appendChild(cell);
    }
}

function startNewGame() {
    getRandomCategories(setupGame);
    localStorage.setItem('gameData', JSON.stringify(gameData));
    gameData.prevGuesses = [];
}

function setupGame(categoryData) {
    if (categoryData.result !== "success") {
        console.error('Failed to load categories');
        return;
    }
    updateStatistics();
    const gameBoard = document.getElementById('gameBoard');
    gameBoard.innerHTML = '';
    let words = categoryData.categories.flatMap(category => category.words);
    if (gameData.removedWords && gameData.removedWords.length > 0) {
        words = words.filter(word => !gameData.removedWords.includes(word));
    }
    words.sort(() => Math.random() - 0.5);
    for (let i = 0; i < words.length; i++) {
        const cell = document.createElement('div');
        cell.classList.add('cell');
        cell.textContent = words[i];
        cell.addEventListener('click', function() {
            if (!this.classList.contains('selected')) {
                if (selectedWords.length === 4) {
                    return;
                }
                this.classList.add('selected');
                this.style.backgroundColor = 'lightgreen';
                selectedWords.push(this.textContent.trim());
            } else {
                this.classList.remove('selected');
                this.style.backgroundColor = '';
                const wordIndex = selectedWords.indexOf(this.textContent.trim());
                if (wordIndex > -1) {
                    selectedWords.splice(wordIndex, 1);
                }
            }
        });
        gameBoard.appendChild(cell);
    }

    gameData['connections'] = categoryData;
    localStorage.setItem('gameData', JSON.stringify(gameData));
}

function submitSelection() {
    if (selectedWords.length === 4) {
        gameData.guessCount++;
        document.getElementById('currentGuessCount').textContent = `Current Guess Count: ${gameData.guessCount}`;
        const categories = gameData['connections'];
        let matchFound = false;
        let maxMatchedWords = 0;
        let right_category;
        for (const category of categories['categories']) {
            let matchedWords = 0;
            for (const word of selectedWords) {
                if (category.words.includes(word)) {
                    matchedWords++;
                }
            }
            if (matchedWords > maxMatchedWords) {
                maxMatchedWords = matchedWords;
            }
            if (matchedWords === 4) {
                right_category = category;
                gameData.categoriesGuessed++;
                matchFound = true;
                document.querySelectorAll('.cell.selected').forEach(cell => {
                    cell.style.display = 'none';
                    cell.classList.remove('selected');
                });
                updatePrevGuesses(true, right_category);
                for (let i = 0; i < selectedWords.length; i++) {
                    gameData.removedWords.push(selectedWords[i]);
                }
                selectedWords = [];
                if (gameData.categoriesGuessed === 4) {
                    document.getElementById("shuffle").style.display = 'none';
                    document.getElementById("submitSelection").style.display = 'none';
                    endGame();
                }
                break;
            }
        }
        if (!matchFound) {
            let message;
            if (maxMatchedWords >= 2) {
                message = `${4 - maxMatchedWords} word(s)/phrase(s) away`;
            } else {
                message = "No matching category found.";
            }
            updatePrevGuesses(false, message);
            selectedWords = [];
            gameData.selectedWords = [];
        }
        document.querySelectorAll('.cell.selected').forEach(cell => {
            cell.style.backgroundColor = '';
            cell.classList.remove('selected');
        });
    } else {
        alert('Please select exactly 4 words.');
    }
    localStorage.setItem('gameData', JSON.stringify(gameData));
}


function endGame() {
    gameData['numberOfWins']++;
    gameData['winStreak']++;
    gameData['numberOfGames']++;
    gameData['totalGuesses'] += gameData.guessCount;
    gameData['averageGuesses'] = gameData.totalGuesses / gameData.numberOfGames;
    updateStatistics();
    localStorage.setItem('gameData', JSON.stringify(gameData));
    document.getElementById("shuffle").style.display = 'none';
    document.getElementById("submitSelection").style.display = 'none';
    const gameBoard = document.getElementById('gameBoard');
    gameBoard.innerHTML = '';
    const gameOver = document.createElement('div');
    gameOver.textContent = "Congrats you won!";
    gameBoard.append(gameOver);

}

function updateStatistics() {
    gameData.averageGuesses = gameData.numberOfGames > 0 ? gameData.totalGuesses / gameData.numberOfGames : 0;

    document.getElementById('totalGamesPlayed').textContent = `Total Games Played: ${gameData.numberOfGames}`;
    document.getElementById('totalWins').textContent = `Total Wins: ${gameData.numberOfWins}`;
    document.getElementById('currentWinStreak').textContent = `Current Win Streak: ${gameData.winStreak}`;
    document.getElementById('averageGuesses').textContent = `Average Number of Guesses: ${gameData.averageGuesses.toFixed(2)}`;
    document.getElementById('currentGuessCount').textContent = `Current Guess Count: ${gameData.guessCount}`;
}

function updatePrevGuesses(wasRight = false, category = "") {
    let newArr = [];
    for (let i = 0; i < 4; i++) {
        newArr.push(selectedWords[i]);
    }
    if (wasRight) {
        newArr.push(category.category);
    }
    else {
        newArr.push(category);
    }
    if (!gameData.prevGuesses) {
        gameData.prevGuesses = [];
    }
    gameData.prevGuesses.push(newArr);
    renderPrevGuesses();
}

function renderPrevGuesses() {
    let prevAnswersDiv = document.getElementById("previousAnswers");
    prevAnswersDiv.innerHTML = "";
    for (let i = 0; i < gameData.prevGuesses.length; i++) {
        const guess = gameData.prevGuesses[i];
        const guessDiv = document.createElement("div");
        if (guess.length > 4) {
            guessDiv.innerHTML = `${guess.slice(0, 4).join(", ")}, <strong>${guess[4]}</strong>`;
        }
        else {
            guessDiv.textContent = `${guess.join(", ")}`;
        }
        prevAnswersDiv.appendChild(guessDiv);
    }
}
