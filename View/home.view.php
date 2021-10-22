<div id="containerHomePage">

    <?php
    use Muffeen\UrlStatus\UrlStatus;

    $url_status = UrlStatus::get('https://packagist.org');
    echo gettype($url_status->getStatusCode()) . "<br>";
    echo $url_status->getStatusCode();
        if (isset($var['link'])){
            foreach ($var['link'] as $link){ ?>
                <div class="oneLink">
                    <div class="icon">
                        <a href="?controller=modifyLink&id=<?= $link['id'] ?>"><i class="fas fa-pen"></i></a>
                        <a href="?controller=deleteLink&id=<?= $link['id'] ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                    <img src="https://decizia.com/blog/wp-content/uploads/2017/06/default-placeholder.png" alt="default image"
                    width="250px" height="250px">
                    <a href="<?= $link['href'] ?>" class="linkName" title="<?= $link['title'] ?>" target="<?= $link['target'] ?>"><?= $link['name'] ?></a>
                </div>
            <?php }
        }
    ?>

</div>