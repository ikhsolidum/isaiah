<div id="subcontent">
    <?php
      switch($action){
                case 'create':
                    require_once 'user/create-user.php';
                break; 
                case 'modify':
                    require_once 'user/modify-user.php';
                break; 
                case 'profile':
                    require_once 'user/view-profile.php';
                break;
                case 'result':
                    require_once 'user/search-user.php';
                break;
                default:
                    require_once 'user/main.php';
                break; 
            }
    ?>
  </div>