    <header>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="pull-left navbar-header">
                    <a href="<?= $ssl ? 'https://' : 'http://'?><?=$domain?>" class="navbar-brand"><i class="fa fa-home" aria-hidden="true"></i>
back to <?= $groupName ?> home page...</a>
                </div>
                <div class="nav" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class='pull-right'><?php
                            if(isset($_SESSION['steamid'])){
                                include ('steamauth/userInfo.php');
                                echo "<li class='pull-right'><a href='?logout='1'><i class='fa fa-sign-out' aria-hidden='true'></i>
Logout</a></li>";
                            }?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>