        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content fixed-sidebar">
            <header class="mn-header navbar-fixed">
                <nav class="cyan darken-1">
                    <div class="nav-wrapper row">
                        <section class="material-design-hamburger navigation-toggle">
                            <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                                <span class="material-design-hamburger__layer"></span>
                            </a>
                        </section>
                        <div class="header-title col s3">      
                            <span class="chapter-title">ELMS | Employee</span>
                        </div>
                     
<?php if(isset($_SESSION['eid'])) {
    $eid = $_SESSION['eid'];
    // Count all approved / not approved leaves for this employee
    $sqlNotifCount = "SELECT COUNT(*) AS cnt FROM tblleaves WHERE empid = :eid AND Status IN (1,2)";
    $queryNotifCount = $dbh->prepare($sqlNotifCount);
    $queryNotifCount->bindParam(':eid',$eid,PDO::PARAM_STR);
    $queryNotifCount->execute();
    $rowNotif = $queryNotifCount->fetch(PDO::FETCH_OBJ);
    $notifCount = $rowNotif ? $rowNotif->cnt : 0;
?>
                        <ul class="right col s9 m3 nav-right-menu">
                            <li class="hide-on-small-and-down">
                                <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large">
                                    <i class="material-icons">notifications_none</i>
                                    <span class="badge"><?php echo htmlentities($notifCount);?></span>
                                </a>
                            </li>
                        </ul>

                        <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                            <li class="notificatoins-dropdown-container">
                                <ul>
                                    <li class="notification-drop-title">Notifications</li>
<?php
    $sqlNotif = "SELECT id, LeaveType, PostingDate, Status FROM tblleaves WHERE empid = :eid AND Status IN (1,2) ORDER BY id DESC LIMIT 5";
    $queryNotif = $dbh->prepare($sqlNotif);
    $queryNotif->bindParam(':eid',$eid,PDO::PARAM_STR);
    $queryNotif->execute();
    $resultsNotif = $queryNotif->fetchAll(PDO::FETCH_OBJ);
    if($queryNotif->rowCount() > 0) {
        foreach($resultsNotif as $n) {
            $iconClass = ($n->Status==1) ? 'green' : 'red';
            $statusText = ($n->Status==1) ? 'Approved' : 'Not Approved';
?>
                                    <li>
                                        <a href="leave-details.php?leaveid=<?php echo htmlentities($n->id);?>">
                                            <div class="notification">
                                                <div class="notification-icon circle <?php echo $iconClass; ?>">
                                                    <i class="material-icons">event_note</i>
                                                </div>
                                                <div class="notification-text">
                                                    <p>Your <?php echo htmlentities($n->LeaveType);?> leave</p>
                                                    <span>on <?php echo htmlentities($n->PostingDate);?> - <?php echo $statusText; ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
<?php
        }
    } else {
?>
                                    <li>
                                        <div class="notification-text" style="padding:10px;">No notifications</div>
                                    </li>
<?php } ?>
                                </ul>
                            </li>
                        </ul>
<?php } ?>

                    </div>
                </nav>
            </header>
