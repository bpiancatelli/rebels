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
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste matchs</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>
                    <div class="x_content">  
                        <table id="table" class="table table-bordered table-hover table-striped table-condensed">
                            <thead class="text-center">
                                <tr class="info">
                                    <th class="text-center">Reference</th>
                                    <th class="text-center">Division</th>
                                    <th class="text-center">Adversaire</th>
                                    <th class="text-center">Date</th>                                    
                                    <th class="text-center">A domicile</th>
                                    <th class="text-center">Score</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php 
                                $ca = new Calendrier_adapter();
                                $ea = new Equipe_adapter();
                                
                            ?>
                            <?php if($matchs != null){ ?>
                                <?php foreach($matchs as $match) {?>   
                                <?php $equipe = $ea->getAdversaireById($match->getIdAdversaire());?>
                                    <tr>
                                        <td><?php echo $match->getReference(); ?></td>
                                        <td><?php echo $match->getIdDivision(); ?></td>
                                        <td><?php echo $equipe->getNomLong(); ?></td>
                                        <td><?php echo $ca->sqlToDate($match->getDateMatch()); ?></td>
                                        <td><?php echo $match->getIsDomicile()? 'Home' : 'Away'; ?></td>
                                        <td><?php echo $match->getScoreHome()." - ".$match->getScoreAway(); ?></td>
                                        <td><a class='btn btn-success btn-xs' href="<?php echo base_url()?>statistique/update/<?php echo $match->getIdMatch();?>">update</a></td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>

                                    <tr>
                                        <td colspan="7">Pas de matchs à updater</td>
                                    </tr>

                            <?php } ?>
                        </table>
                    </div>
            </div>            


    
</div>



























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