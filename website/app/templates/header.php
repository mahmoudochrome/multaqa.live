<header>
    <div class="flex-auto">
        <h1 id="HeaderTitle"></h1>
        <h2 id="HeaderSubTitle" class="text-sm"></h2>
    </div>
    <div class="header-links">
        <?php if(!isset($_SESSION['user_id'])) {?>
        <a id="Login" href="/Login"></a> &middot;
        <a id="signup" href="/Signup/"></a> &middot;
        <?php } else { ?>
        <a id="logout" href="/Logout/"></a>
        <?php } ?>
        <br>
        Lang:
        <a href="#" id="ar">AR</a> -
        <a href="#" id="en">EN</a>
    </div>
</header>