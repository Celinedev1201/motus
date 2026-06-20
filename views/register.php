<section class="auth-container">

    <div class="auth-card">

        <h1>Inscription</h1>

        <form id="register-form" action="/register" method="POST">

            <div class="form-group">
                <label>Pseudo</label>
                <input
                    type="text"
                    name="pseudo"
                    placeholder="Votre pseudo"
                    required
                >
            </div>

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
                Créer un compte
            </button>

        </form>

        <p id="register-message"></p>

        <p class="auth-link">
            Déjà inscrit ?
            <a href="/login">Se connecter</a>
        </p>

    </div>

</section>

<script src="/assets/js/auth.js"></script>