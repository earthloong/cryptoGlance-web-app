<?php
include('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}

require_once('includes/cryptoglance.php');
$cryptoGlance = new CryptoGlance();

$jsArray = array(
    'ajax',
    'rigs',
    'pools',
    'wallets',
);

include("includes/header.php");
?>
         
   <div id="dashboard-wrap" class="container sub-nav">
   
   <?php 
   if (count($cryptoGlance->getMiners()) == 0 && count($cryptoGlance->getPools()) == 0 && count($cryptoGlance->getWallets()) == 0) {
   ?>
    <!-- TODO: If there are NO panels yet, then show this div // CSS is around line 1140 (set 'display: none' pls!) -->
    <div id="first-run-notice"><b>Start by adding a panel.</b><br>The Dashboard is comprised of a variety of panels, each showing a certain type of info.<span><a href="#add-panel" id="flash-add-panel"><button type="button" class="btn btn-lg btn-warning" data-type="all"><i class="icon icon-newtab"></i> Add Panel</button></a></span></div>
   
    <?php
    }
    
    // Overview
    if (count($cryptoGlance->getMiners()) > 0) {
        include("templates/panel-overview.php");
    
        // Miners
        foreach ($cryptoGlance->getMiners() as $minerId => $miner) {
            $minerId++; // Doing this because minerID 0 means all devices in ajax calls
            include("templates/panel-rig.php");
        }
        include("templates/modals/switch-pool.php");
    }
   
    ?>

      <?php
      foreach ($cryptoGlance->getPools() as $poolId => $pool) {
        $poolId++;
        include("templates/panel-pool.php");
      }
      ?>

      <?php //require_once("templates/panel-news_feed.php"); ?>
      
      <?php //require_once("templates/panel-subreddit_feed.php"); ?>
                           
      <?php //require_once("templates/panel-coinwatcher.php"); ?>

      <?php
      if (count($cryptoGlance->getWallets()) > 0) {
        include("templates/panel-wallet.php");
      }
      
      if (count($cryptoGlance->getMiners()) > 0 || count($cryptoGlance->getPools()) > 0) {
        include("templates/modals/delete_prompt.php");
      }
      
        include("templates/modals/add_rig.php");
        include("templates/modals/add_pool.php");
      ?>
      
   </div>
   <!-- /container -->

   <?php require_once("includes/footer.php"); ?>
   </div>
   <!-- /page-container -->


<?php //require_once("templates/modals/switch_pool.php"); ?>

<?php //require_once("templates/modals/delete_prompt.php"); ?>

    <?php require_once("includes/scripts.php"); ?>
</body>
</html>
