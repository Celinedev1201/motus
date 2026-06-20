<section class="hero">

    <div class="hero-content">

        <h1><span>MO</span>TUS</h1>

        <h2>Trouvez le mot secret en 6 essais</h2>

        <p>
            Une première lettre affichée, six tentatives,
            et votre cerveau prié de coopérer.
        </p>

       <div class="hero-actions">
  <a href="/game" class="btn btn-red">
    ▶ Jouer maintenant
</a>
</div>
    </div>

    <div class="home-game-preview">

        <div class="motus-grid">
            <?php for ($row = 0; $row < 6; $row++): ?>
                <div class="motus-row">
                    <?php for ($col = 0; $col < 5; $col++): ?>
                        <div class="motus-cell"></div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>

    </div>

</section>