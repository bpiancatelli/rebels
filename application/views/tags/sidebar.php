<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php echo base_url()?>../images/logo/rebels1.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bienvenue</span>
                            <h2><?php echo $this->session->userdata('prenom');?></h2>
                            <h2>Licence N° : <?php echo $this->session->userdata('licence');?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                    
                            <h3>General</h3>       
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url()?>membre/index"><i class="fa fa-home"></i>Home</a></li>
                                <li><a href="<?php echo base_url()?>membre/annonce"><i class="fa fa-bullhorn"></i>Annonces</a></li>
                                <li><a href="<?php echo base_url()?>exercice/index"><i class="fa fa-check"></i>Exercices</a></li>

                                <li><a><i class="fa fa-bar-chart-o"></i> Statistiques <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>statistique/division">Toutes les divisions</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>statistique/search">Recherche avancée</a>
                                        </li>
                                                                           
                                   <?php if($divisions != null and $divisions != ''){
                                            foreach ($divisions as $division) { ?>
                                                <li><a href="<?php echo base_url()?>statistique/division/<?php echo $division->getIdDivision() ?>"><?php echo $division->getNom()?></a>
                                                </li>
                                            <?php }?>
                                        <?php }?>
                                            
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url()?>drivertool/show"><i class="fa fa-taxi"></i>Driver Tool</a></li>
                                
                                <!--<li><a href="<?php echo base_url()?>forum/show/dossier"><i class="fa fa-folder-open"></i>Forum</a></li>!-->
                                <!--<li><a href="<?php echo base_url()?>statistique/search"><i class="fa fa-archive"></i>Archives</a>                                   
                                </li>-->

                                <?php if($this->session->userdata('administrateur')) { ?>
                                <li><a><i class="fa fa-lock"></i>Administrateur<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>membre/show/membre"><i class="fa fa-user"></i>Membre</a></li>                                        
                                        <li><a href="<?php echo base_url()?>membre/show/match"><i class="fa fa-trophy"></i>Match</a></li>
                                        <li><a href="<?php echo base_url()?>membre/show/calendrier"><i class="fa fa-calendar"></i>Match Amicaux</a></li>
                                        <li><a href="<?php echo base_url()?>membre/show/curlcalendrier"><i class="fa fa-calendar"></i>Calendrier</a></li>
                                        <li><a href="<?php echo base_url()?>admin/curlmembre"><i class="fa fa-users"></i>Ingest players</a></li>
                                        <?php //if($this->session->userdata('prenom') == 'Guillaume' && $this->session->userdata('nom') == 'Gailliet'){ ?>
                                        <!-- <li><a href="<?php echo base_url()?>membre/show/cotisation"><i class="fa fa-lock"></i>Cotisation</a></li> -->
                                        <?php //} ?>                                        
                                    </ul>    
                                </li>
                                
                                <li><a><i class="fa fa-pie-chart"></i>Reporting<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <?php if($this->session->userdata('prenom') == 'Benoit' && $this->session->userdata('nom') == 'Piancatelli'){ ?>
                                            <!-- <li><a href="<?php echo base_url()?>membre/show/log"><i class="fa fa-database"></i>Form Log</a></li> -->
                                            <!--<li><a href="<?php echo base_url()?>reporting/mailing"><i class="fa fa-envelope-o"></i>Email</a></li>-->                                            
                                        <?php } ?>
                                            <li><a href="<?php echo base_url()?>membre/show/drivertool"><i class="fa fa-taxi"></i>Driver Tool</a></li>
                                    </ul>
                                </li>
                                    
                                <?php } ?>

                                 <li><a><i class="fa fa-user"></i>Mon compte <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>membre/update/0"><i class="fa fa-info"></i>Modifier mes données</a></li>
                                        <li><a href="<?php echo base_url()?>membre/logout"><i class="fa fa-sign-out"></i>Se déconnecter</a></li>
                                    </ul>
                                </li>    

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
