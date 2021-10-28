<?php $title = "Page d'accueil" ?>
<?php ob_start(); ?>
<div class="flexCenterBig1">
    <div id="flexCenterBig2">
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
                <p class="chapterContent">
                    <?= nl2br(htmlspecialchars($postsArray['postContent'])) ?>
                </p>
                <a
                    href="index.php?action=post&id=<?= $postsArray['id'] ?>">
                    <p class="chapterComments">
                        Commentaires
                    </p>
                </a>
            </div>
            <?php
            }
            $posts->closeCursor();
            ?>
        </div>
        <div id="flexRight">
            <h3>Tous les chapitres</h3>
            <?php
            while ($postsArray = $posts->fetch()) {
                ?>
            <a
                href="index.php?action=post&id=<?= $postsArray['id'] ?>">
                <p><?= htmlspecialchars($postsArray['postTitle']) ?>
                </p>
            </a>
            <?php
            }
            $posts->closeCursor();
            ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'template/template.php';
