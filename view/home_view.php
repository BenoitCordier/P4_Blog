<?php $title = "Page d'accueil" ?>
<?php ob_start(); ?>
<div class="flexCenterBig1">
    <div id="flexCenterBig2">
        <!-- Biographie de l'auteur -->
        <div id="flexLeft">
            <h3>L'auteur</h3>
            <p class="bio">
                « Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor,
                dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula
                massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est
                eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae,
                consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras
                vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim.»
            </p>
        </div>
        <!-- Cinq derniers chapitres publiés -->
        <div id="flexCenter">
            <h2 id="lastChapter">Derniers chapitres</h2>
            <?php
            while ($postsArray = $posts->fetch()) {
                ?>
            <div class="chapter">
                <h3><a
                        href="index.php?action=post&id=<?= $postsArray['id'] ?>">
                        <?= htmlspecialchars($postsArray['postTitle']) ?>
                    </a></h3>
                <h4>le <?= $postsArray['postDateFr'] ?>
                </h4>
                <div class="chapterContent">
                    <?= nl2br(htmlspecialchars_decode($postsArray['postContent'])) ?>
                </div>
                <a href="index.php?action=post&id=<?= $postsArray['id'] ?>"
                    class="chapterComments signal">
                    Commentaires

                </a>
            </div>
            <?php
            }
            $posts->closeCursor();
            ?>
        </div>
        <!-- Encart de navigation -->
        <div id="flexRight">
            <h3>Les chapitres</h3>
            <?php
            while ($titlesArray = $titles->fetch()) {
                ?>
            <a
                href="index.php?action=post&id=<?= $titlesArray['id'] ?>">
                <?= htmlspecialchars($titlesArray['postTitle']) ?>
            </a>
            <?php
            }
            $titles->closeCursor();
            ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'template/template.php';
