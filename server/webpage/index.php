<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>sample page</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header id="top">
        <h1>Title</h1>
        <nav>
            <ul>
                <li>
                    <p><a href="#info">Info</a></p>
                </li>
                <li>
                    <p><a href="#photo">Photo</a></p>
                </li>
                <li>
                    <p><a href="#contact">Contact</a></p>
                </li>
            </ul>
        </nav>
    </header>
    <section id="info">
        <p><img class="bg_image" src="images/about_bg_img.jpg" alt=""></p>
        <h1>Info</h1>
        <div class="container">
            <ul class="info_list">
                <li>
                    <?php
                    $template = '
                    <p><img src="images/340x180.png" width="340" height="180" alt=""></p>
                    <p>{{title}}</p>
                    <p>{{body}}</p>
                    ';
                    require_once('cms.php');
                    $cms = new MyCMS\CMS($template, 2);
                    $cms->render();
                    ?>
                </li>
            </ul>
        </div>
    </section>
    <section id="photo">
        <h1>Photo</h1>
        <div class="container">
            <ul class="photo_image">
                <li>
                    <p><img src="images/150x150.png" width="150" height="150" alt=""></p>
                    <p>sample sample sample sample sample sample sample</p>
                </li>
                <li>
                    <p><img src="images/150x150.png" width="150" height="150" alt=""></p>
                    <p>sample sample sample sample sample sample sample</p>
                </li>
                <li>
                    <p><img src="images/150x150.png" width="150" height="150" alt=""></p>
                    <p>sample sample sample sample sample sample sample</p>
                </li>
                <li>
                    <p><img src="images/150x150.png" width="150" height="150" alt=""></p>
                    <p>sample sample sample sample sample sample sample</p>
                </li>
            </ul>
        </div>
    </section>
    <section id="contact">
        <h1>Contact</h1>
        <div class="container">
            <dl class="contact_list">
                <dt>TEL</dt>
                <dd>
                    <address>000-0000-0000</address>
                </dd>
                <dt>Email</dt>
                <dd>
                    <address>email@example.com</address>
                </dd>
            </dl>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>(c) 2015 xxx.</p>
        </div>
    </footer>
</body>

</html>