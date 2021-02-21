    <footer class="footer hidden-xs-down">
        <p>© <span style="font-family:JetBrains Mono;font-weight:bold">DTeam.</span> All rights reserved.</p>
        <p>www.dteam.tech</p>
        <?php
            if($this->session->type == 'addmin')
            {
        ?>
        <ul class="nav footer__nav">
            <a class="nav-link" href=<?=site_url('utilisateur/index')?>>Utilisateurs</a>

            <a class="nav-link" href=<?=site_url('exercice/index')?>>Exercices</a>

            <a class="nav-link" href=<?=site_url('signinup/profile')?>>Profile</a>                
        </ul>
        <?php
            }
        ?>
    </footer>
    </body>
</html>