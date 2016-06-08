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
            <div class="col-md-12 col-sm-12 col-xs-12 ">  
                <div class="x_panel tile fixed_height_350 text-center">
                    <div class="x_title">
                        <?php 
                            $m = new Membre_adapter();
                            $membre =  $m->getMembreById($matchMembre->getIdMembre());
                            
                        ?>
                        <h2>Update du joueur <?php echo $membre->getNom()." ".$membre->getPrenom() ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                           
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <?php                     
                        echo form_open('statistique/launchUpdate/'.$matchMembre->getIdMatch()."/".$matchMembre->getIdMembre());
                    ?>  
                    <form>
                            <table id="table" class="table table-bordered table-hover table-striped table-condensed">
                                <thead class="text-center">
                                    <tr class="info">
                                        <th class="text-center">Joueur</th>
                                        <?php foreach($stats as $key => $value) { ?>
                                            <th class="text-center"><?php echo strtoupper($value) ?></th>
                                        <?php } ?>

                                        <th class="text-center">Save</th>      

                                    </tr>
                                </thead>
                                <?php                                                                         
                                    $mm = new Match_membre_model();
                                    $m = new Membre_adapter();                                                         
                                ?>
                                
                                <?php 
                                    $membre = $m->getMembreById($matchMembre->getIdMembre());
                                    $pa = $mm->calculPA($matchMembre->getSimpleHit(),
                                                $matchMembre->getDoubleHit(),
                                                $matchMembre->getTripleHit(),
                                                $matchMembre->getHr(),
                                                $matchMembre->getRoe(),
                                                $matchMembre->getHbp(),
                                                $matchMembre->getGofo(),
                                                $matchMembre->getSac(),
                                                $matchMembre->getBb(),
                                                $matchMembre->getK()
                                                );

                                    $ab = $mm->calculAB($pa, $matchMembre->getHbp(), $matchMembre->getBb());
                                    $hits = $mm->calculHits($matchMembre->getSimpleHit(), $matchMembre->getDoubleHit(), $matchMembre->getTripleHit(), $matchMembre->getHr());
                                    $bbrat = $mm->calculBBrat($matchMembre->getBb(),$pa);
                                    $krat = $mm->calculKrat($pa,$matchMembre->getK());
                                    $avg = $mm->calculAVG($ab,$hits);
                                    $obp = $mm->calculOBrat($ab,$hits,$matchMembre->getHbp(),$matchMembre->getBb());
                                    $slug = $mm->calculSLUGrat($ab,$matchMembre->getSimpleHit(),$matchMembre->getDoubleHit(),$matchMembre->getTripleHit(),$matchMembre->getHr());
                                    $sbrat = $mm->calculSBrat($matchMembre->getSb(),$matchMembre->getCs());

                                ?>
                                <tr>
                                    <td><?php echo $membre->getNom()." ".$membre->getPrenom() ?> </input></td>                                    
                                    <td><input type="text" size="1" name="simpleHit" value="<?php echo $matchMembre->getSimpleHit();?>"/></td>
                                    <td><input type="text" size="1" name="doubleHit" value="<?php echo $matchMembre->getDoubleHit();?>" /></td>
                                    <td><input type="text" size="1" name="tripleHit" value="<?php echo $matchMembre->getTripleHit();?>" /></td>
                                    <td><input type="text" size="1" name="hr" value="<?php echo $matchMembre->getHr();?>" /></td>
                                    <td><input type="text" size="1" name="roe" value="<?php echo $matchMembre->getRoe();?>" /></td>
                                    <td><input type="text" size="1" name="hbp" value="<?php echo $matchMembre->getHbp();?>" /></td>
                                    <td><input type="text" size="1" name="gofo" value="<?php echo $matchMembre->getGofo();?>" /></td>
                                    <td><input type="text" size="1" name="sac" value="<?php echo $matchMembre->getSac();?>" /></td>
                                    <td><input type="text" size="1" name="bb" value="<?php echo $matchMembre->getBb();?>" /></td>
                                    <td><input type="text" size="1" name="k" value="<?php echo $matchMembre->getK();?>" /></td>
                                    <td><input type="text" size="1" name="rbi" value="<?php echo $matchMembre->getRbi();?>" /></td>
                                    <td><input type="text" size="1" name="runs" value="<?php echo $matchMembre->getRuns();?>" /></td>
                                    <td><input type="text" size="1" name="sb" value="<?php echo $matchMembre->getSb();?>" /></td>
                                    <td><input type="text" size="1" name="cs" value="<?php echo $matchMembre->getCs();?>" /></td>
                                    <td><input class="btn btn-success btn-xs" type="submit" name="submit_joueur" value="Updater" /></td>
                                   
                                </tr>
                                
                            </table>
                    </form>
                </div>            
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