<?php 

    $gentelella = base_url()."../plugins/gentelella/production/";
    $datatables = base_url()."../plugins/datatables/";

?>



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
                                    <th class="text-center">Joueur</th>
                                    <th class="text-center">Division</th>
                                    <th class="text-center">Adversaire</th>
                                    <th class="text-center">PA</th>                                    
                                    <th class="text-center">AB</th>
                                    <th class="text-center">H</th>
                                    <th class="text-center">RBI</th>
                                    <th class="text-center">AVG</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">(%)</th>
                                    <th class="text-center">BB</th>
                                    <th class="text-center">(%)</th>                                    
                                    <th class="text-center">OBP</th>
                                    <th class="text-center">SLUG%</th>
                                    <th class="text-center">SB%</th>
                                </tr>
                            </thead>
                            <?php 
                                $ca = new Calendrier_adapter();
                                $ea = new Equipe_adapter();
                                $m = new Membre_adapter();
                                $ma = new Match_adapter();
                                $mm = new Match_membre_model();                                
                            ?>
                            <?php if($resultats != null){ ?>
                                <?php foreach($resultats as $resultat) {?>   
                                <?php 
                                    $equipe = $ea->getAdversaireByIdMatchMembre($resultat->getIdMatch());
                                    $match = $ma->getMatchById($resultat->getIdMatch());
                                    $membre = $m->getMembreById($resultat->getIdMembre());

                                    $pa = $resultat->getPa();
                                    $ab = $resultat->getAb();
                                    $hits = $resultat->getHit();
                                    $bbrat = $mm->calculBBrat($resultat->getBb(),$pa);
                                    $krat = $mm->calculKrat($pa,$resultat->getK());
                                    $avg = $mm->calculAVG($ab,$hits);
                                    $obp = $mm->calculOBrat($ab,$hits,$resultat->getHbp(),$resultat->getBb());
                                    $slug = $mm->calculSLUGrat($ab,$resultat->getSimpleHit(),$resultat->getDoubleHit(),$resultat->getTripleHit(),$resultat->getHr());
                                    $sbrat = $mm->calculSBrat($resultat->getSb(),$resultat->getCs());

                                ?>
                                    <tr>
                                        <td><?php echo $membre->getNom()." ".$membre->getPrenom(); ?></td>
                                        <td><?php echo $match->getIdDivision() ?></td>
                                        <td><?php echo $equipe->getNomLong() ?></td>
                                        <td><?php echo $pa ?></td>
                                        <td><?php echo $ab?> </td>
                                        <td><?php echo $hits?></td>
                                        <td><?php echo $resultat->getRbi()?></td>
                                        <td><?php echo $avg ?></td>
                                        <td><?php echo $resultat->getK()?></td>
                                        <td><?php echo $krat?></td>
                                        <td><?php echo $resultat->getBb()?></td>
                                        <td><?php echo $bbrat ?></td>
                                        <td><?php echo $obp ?></td>
                                        <td><?php echo $slug ?></td>
                                        <td><?php echo $sbrat ?></td>

                                        
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>

                                    <tr>
                                        <td colspan="15">Pas de données</td>
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