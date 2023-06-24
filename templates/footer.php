</main>
        
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="index.php?controller=page&action=home" class="nav-link px-2 text-body-secondary">Accueil</a></li>
                <li class="nav-item"><a href="index.php?controller=mission&action=list" class="nav-link px-2 text-body-secondary">Missions</a></li>
                <?php 
                if (isset($_SESSION['user'])) {
                    echo '
                    <li><a href="index.php?controller=target&action=list" class="nav-link px-2 text-body-secondary">Cibles</a></li>
                    <li><a href="index.php?controller=contact&action=list" class="nav-link px-2 text-body-secondary">Contacts</a></li>
                    <li><a href="index.php?controller=hideout&action=list" class="nav-link px-2 text-body-secondary">Planques</a></li>
                    <li><a href="index.php?controller=agent&action=list" class="nav-link px-2 text-body-secondary">Agents</a></li>
                    ';
                }
            ?>
            </ul>
            <p class="text-center text-body-secondary">© 2023 KGB Inc.</p>
        </footer>
    </div>

</body>
</html>