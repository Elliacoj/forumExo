<h2>Connexion / Création</h2>
<div id="loginCreateDiv">
    <div id="loginDiv">
        <h3>Connexion</h3>
        <form action="" method="post">
            <div>
                <label for="loginUsername">Nom d'utilisateur:</label>
                <input type="text" id="loginUsername" name="loginUsername" required title="Votre nom d'utilisateur" maxlength="45">
            </div>

            <div>
                <label for="loginPassword">Mot de passe:</label>
                <input type="password" id="loginPassword" name="loginPassword" required
                       title="Une majuscule, minuscule, 1 chiffre et 1 caractère spécifique requis.">
            </div>

            <div>
                <input type="submit" class="buttonSubmit">
            </div>
        </form>
        <p id="buttonSwitchCreate">Pas encore de compte? Créez le votre ici.</p>
    </div>

    <div id="createDiv">
        <h3>Création de compte</h3>
        <form action="../index.php?controller=user&action=create" method="post">
            <div>
                <label for="createUsername">Nom d'utilisateur:</label>
                <input type="text" id="createUsername" name="createUsername" required title="Votre nom d'utilisateur" maxlength="45">
            </div>

            <div>
                <label for="createMail">Adresse mail:</label>
                <input type="email" id="createMail" name="createMail" required title="Votre adresse mail" maxlength="65">
            </div>

            <div>
                <label for="createPassword">Mot de passe:</label>
                <input type="password" id="createPassword" name="createPassword" required
                       title="Une majuscule, minuscule, 1 chiffre et 1 caractère spécifique requis.">
            </div>

            <div>
                <label for="createCheckPassword">Confirmation du mot de passe:</label>
                <input type="password" id="createCheckPassword" name="createCheckPassword" required
                       title="Une majuscule, minuscule, 1 chiffre et 1 caractère spécifique requis.">
            </div>

            <div>
                <input type="submit" class="buttonSubmit" id="buttonCreate">
            </div>
        </form>
        <p id="buttonSwitchLogin">Vous avez dejà un compte? Connectez vous ici.</p>
    </div>
</div>
