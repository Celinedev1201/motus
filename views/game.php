<section class="game-page">

    <aside class="game-panel">

        <h1>Partie Motus</h1>

        <p>
            Trouvez le mot secret en 6 essais.
            La première lettre est déjà donnée.
        </p>

        <form method="GET" action="/game">

            <div class="difficulty-box">

                <label for="difficulty">Difficulté</label>

                <select
                    id="difficulty"
                    name="difficulty"
                    onchange="this.form.submit()"
                >
                    <option
                        value="facile"
                        <?= ($_SESSION['difficulty'] ?? 'facile') === 'facile' ? 'selected' : '' ?>
                    >
                        Facile
                    </option>

                    <option
                        value="moyen"
                        <?= ($_SESSION['difficulty'] ?? '') === 'moyen' ? 'selected' : '' ?>
                    >
                        Moyen
                    </option>

                    <option
                        value="difficile"
                        <?= ($_SESSION['difficulty'] ?? '') === 'difficile' ? 'selected' : '' ?>
                    >
                        Difficile
                    </option>
                </select>

            </div>

        </form>

        <ul>
            <li><span class="dot correct"></span> Lettre bien placée</li>
            <li><span class="dot present"></span> Lettre présente mais mal placée</li>
            <li><span class="dot wrong"></span> Lettre absente du mot</li>
        </ul>

        <a
            href="/new-game?difficulty=<?= $_SESSION['difficulty'] ?? 'facile' ?>"
            class="btn btn-red"
        >
            Nouvelle partie
        </a>

    </aside>

    <div class="game-container">

        <div class="game-header">
            <h2>À vous de jouer</h2>
            <p>Entrez un mot.</p>
        </div>

        <div class="motus-grid">

            <?php for ($row = 0; $row < 6; $row++): ?>

                <?php
                    $guess = $_SESSION['guesses'][$row] ?? '';
                    $result = $_SESSION['results'][$row] ?? [];
                ?>

                <div class="motus-row">

                    <?php for ($col = 0; $col < 5; $col++): ?>

                        <?php $status = $result[$col] ?? ''; ?>

                        <div class="motus-cell <?= $status ?>">
                            <?= htmlspecialchars($guess[$col] ?? '') ?>
                        </div>

                    <?php endfor; ?>

                </div>

            <?php endfor; ?>

        </div>

        <form class="guess-form" id="guess-form">

            <input
                type="text"
                name="guess"
                placeholder="Votre mot"
                maxlength="<?= strlen($_SESSION['word']) ?>"
                required
            >

            <button
                type="submit"
                class="btn-primary"
            >
                Valider
            </button>

        </form>

        <p id="guess-message"></p>

    </div>

</section>

<script src="/assets/js/game.js"></script>