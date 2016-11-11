<?php 

    $gentelella = base_url()."../plugins/gentelella/production/";
    $datatables = base_url()."../plugins/datatables/";

?>


<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>                        
        </nav>
    </div>

</div>


<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">  
            <div class="x_panel tile fixed_height_350">
                <div class="x_title">
                    <h2>Driver Tool Report</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <table id="table" class="table table-bordered table-hover table-striped table-condensed">
                    <thead class="text-center">
                        <tr class="info">
                            <th class="text-center">Membre</th>
                            <th class="text-center">Adversaire</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Coût</th>
                            <th class="text-center">Voiture ?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $c = new Calendrier_adapter();
                            $m = new Membre_adapter();
                            $e = new Equipe_adapter();
                            $ma = new Match_adapter();
                            
                        ?>
                        <?php if($driverLog != null){ ?>
                            <?php foreach($driverLog as $log) {?>  

                                <?php if ($log->getTookHisCar()){ ?>

                                    <?php 

                                        $membre = $m->getMembreById($log->getIdMembre());
                                        $equipe = $e->getAdversaireByIdMatch($log->getIdMatch());
                                        $match = $ma->getMatchById($log->getIdMatch());

                                    ?>

                                    <tr>
                                        <td><?php echo $membre->getNom()." ".$membre->getPrenom(); ?></td>                                    
                                        <td><?php echo $equipe->getNomLong(); ?></td>
                                        <td><?php echo $c->sqlToDate($c->suppressMidnight($match->getDateMatch())); ?></td>
                                        <td><?php echo $log->getTravelCost(); ?> €</td>
                                        <td><?php echo $log->getTookHisCar()  ? 
                                                        "<div class='alert-success alert-xs'>Oui</div>" :
                                                        "<div class='alert-danger alert-xs'>Non</div>"
                                                        ?>
                                                </td>                                   
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php }else{ ?>

                                <tr>
                                    <td colspan="3">Pas de logs</td>
                                </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
        




































<script>setTimeout(function() {
    $('.alertmessage').fadeOut('slow');
}, 2000); // <-- time in milliseconds
</script>     

<div id="custom_notifications" class="custom-notifications dsp_none">
<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
</ul>
<div class="clearfix"></div>
<div id="notif-group" class="tabbed_notifications"></div>
</div>


<script type="text/javascript" src="<?php echo $datatables ?>datatables.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>        
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $gentelella?>js/bootstrap.min.js"></script>


<!-- chart js -->
<script src="<?php echo $gentelella?>js/chartjs/chart.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo $gentelella?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo $gentelella?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo $gentelella?>js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo $gentelella?>js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $gentelella?>js/datepicker/daterangepicker.js"></script>

<script src="<?php echo $gentelella?>js/custom.js"></script>