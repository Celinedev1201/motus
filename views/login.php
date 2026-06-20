<section class="auth-container">

    <div class="auth-card">

        <h1>Connexion</h1>

        <form id="login-form" action="/login" method="POST">

            <div class="form-group">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Votre email"
                    required
                >
            </div>

            <div class="form-group">
                <label>Mot de passe</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Votre mot de passe"
                    required
                >
            </div>

            <button type="submit" class="btn-primary">
                Se connecter
            </button>

        </form>

        <p id="login-message"></p>

        <p class="auth-link">
            Pas encore inscrit ?
            <a href="/register">Créer un compte</a>
        </p>

    </div>

</section>

<script src="/assets/js/auth.js"></script>