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
            <div class="col-md-4 col-sm-4 col-xs-12 ">  
                <div class="x_panel tile fixed_height_350 text-center">
                    <div class="x_title">
                        <h2>Résultat du match</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                           
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <?php                     
                        echo form_open('statistique/setscore/'.$match->getIdMatch());
                    ?>  
                    <form>
                        <table class="col-md-12 col-sm-12 col-xs-18">
                            <tbody>
                                <div class="x_content">  
                                    <?php if(isset($erreur['match']) && $erreur['match'] !=null) { ?>
                                        <div class="alertmessage alert alert-danger">                                                                                        
                                            <?php echo $erreur['match']; ?>                                                                                              
                                        </div>
                                    <?php }?>
                                    <?php if(isset($succes['match']) && $succes['match'] !=null) { ?>
                                    <div class="alertmessage alert alert-success">                                                                                        
                                        <?php echo $succes['match']; ?>                                                                                              
                                    </div>
                                    <?php }?>
                                    <tr>
                                        
                                        <td colspan="2"><span><h3>Score</h3></span></td>
                                        
                                    </tr>        
                                    <tr>
                                        <?php 
                                            echo $match->getIsDomicile() ?
                                                "<td>Rebels</td><td>".$equipe->getNomCourt()."</td>" : 
                                                "<td>".$equipe->getNomCourt()."</td><td>Rebels</td>";

                                        ?>
                                    </tr>
                                    <tr>                                        
                                        <td><input type="text" size="5" name="scoreHome" required></input></td>
                                        <td><input type="text" size="5" name="scoreAway" required></input></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="w_left w_30">
                                                <input class="btn btn-primary" type="submit" name="submit_match" value="Ajouter" />
                                            </div>
                                        </td>  
                                    </tr>                                 
                                </div>
                            </tbody>
                        </table>
                    </form>
                </div>            
            </div>
<?php if(isset($display) && $display){?>
            <div class="col-md-12 col-sm-12 col-xs-12">          
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Mis à jour du match contre <?php echo $equipe->getNomLong() ?> du 
                            <?php 
                                $ca = new Calendrier_adapter();
                                $date =  $ca->sqlToDate($match->getDateMatch());
                                echo $date;
                            ?> référence (<?php echo $match->getReference() ?>)
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                        <div class="x_content"> 

                    <?php                     
                        echo form_open('statistique/setjoueur/'.$match->getIdMatch());
                    ?> 
                            <form>
                            <table class="table table-bordered table-hover table-striped table-condensed">
                                <thead class="text-center">
                                    <tr class="info">
                                        <th class="text-center">Joueur</th>
                                        <?php foreach($stats as $key => $value) { ?>
                                            <th class="text-center"><?php echo $value?></th>
                                        <?php } ?> 
                                        <th class="text-center">Action</th>                                     

                                    </tr>
                                </thead>
                                <?php 
                                    $ca = new Calendrier_adapter();
                                    $ea = new Equipe_adapter();
                                    
                                ?>
                                <tr>
                                    <td class="col-md-2 col-sm-2 col-xs-4">
                                        <select class="form-control" name="joueur">
                                            <?php foreach($joueurs as $joueur) { ?>                                            
                                                <option value="<?php echo $joueur->getIdMembre()?>">
                                                    <?php echo $joueur->getNom()." ".$joueur->getPrenom(); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                               
                                    <?php foreach($stats as $key =>$value) { ?>
                                        <td class="text-center">
                                            <input type="text" size="1" name="<?php echo $key ?>"></input>
                                        </td>
                                    <?php } ?>

                                    <td colspan="2">
                                        <div class="w_left w_30">
                                            <input class="btn btn-success" type="submit" name="submit_joueur" value="Ajouter" />
                                        </div>
                                    </td>  

                            

                                </tr>

                            </table>
                            </form>
                        </div>
                </div>            
            </div>  
        <?php } ?>   
    </div> 

<?php if(isset($matchMembre) && $matchMembre != null) { ?>

<div class="col-md-12 col-sm-12 col-xs-12">          
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste des joueurs</h2>
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

                                        <?php foreach($statsJoueurs as $key => $value) { ?>
                                            <th class="text-center"><?php echo strtoupper($value) ?></th>
                                        <?php } ?>
                                        
                                    </tr>
                                </thead>
                                <?php                                                                         
                                    $mm = new Match_membre_model();
                                    $m = new Membre_adapter();                                                         
                                    $e = new Equipe_adapter();
                                    $ma = new Match_adapter()
                                ?>
                                    <?php foreach($matchMembre as $joueur) { ?>
                                    <?php 
                                        $membre = $m->getMembreById($joueur->getIdMembre());
                                        $match = $ma->getMatchById($joueur->getIdMatch());
                                        $adversaire = $e->getAdversaireByIdMatch($joueur->getIdMatch());
                                        $pa = $mm->calculPA($joueur->getSimpleHit(),
                                                    $joueur->getDoubleHit(),
                                                    $joueur->getTripleHit(),
                                                    $joueur->getHr(),
                                                    $joueur->getRoe(),
                                                    $joueur->getHbp(),
                                                    $joueur->getGofo(),
                                                    $joueur->getSac(),
                                                    $joueur->getBb(),
                                                    $joueur->getK()
                                                    );

                                        $ab = $mm->calculAB($pa, $joueur->getHbp(), $joueur->getBb());
                                        $hits = $mm->calculHits($joueur->getSimpleHit(), $joueur->getDoubleHit(), $joueur->getTripleHit(), $joueur->getHr());
                                        $bbrat = $mm->calculBBrat($joueur->getBb(),$pa);
                                        $krat = $mm->calculKrat($pa,$joueur->getK());
                                        $avg = $mm->calculAVG($ab,$hits);
                                        $obp = $mm->calculOBrat($ab,$hits,$joueur->getHbp(),$joueur->getBb());
                                        $slug = $mm->calculSLUGrat($ab,$joueur->getSimpleHit(),$joueur->getDoubleHit(),$joueur->getTripleHit(),$joueur->getHr());
                                        $sbrat = $mm->calculSBrat($joueur->getSb(),$joueur->getCs());

                                    ?>
                                    <tr>                                        
                                        <td> <?php echo $membre->getNom()." ".substr($membre->getPrenom(), 0,1)."." ?> </td>
                                        <td><?php echo $match->getIdDivision() ?></td>
                                        <td><?php echo $adversaire->getNomCourt() ?></td>
                                        <td><?php echo $pa ?></td>
                                        <td><?php echo $ab ?></td>
                                        <td><?php echo $hits ?></td>
                                        <td><?php echo $joueur->getRbi() ?></td>
                                        <td><?php echo $avg ?></td>
                                        <td><?php echo $joueur->getK() ?></td>
                                        <td><?php echo $krat ?></td>
                                        <td><?php echo $joueur->getBb() ?></td>
                                        <td><?php echo $bbrat ?></td>
                                        <td><?php echo $obp ?></td>
                                        <td><?php echo $slug ?></td>
                                        <td><?php echo $sbrat ?></td>

                                        <td> <a href="<?php echo base_url()?>statistique/updateJoueur/<?php echo $joueur->getIdMatch()."/".$joueur->getIdMembre() ?>"><i class="fa fa-pencil"></i></a></td>
                                       
                                    </tr>
                                <?php } ?>
                            </table>
                    </div>
            </div>
</div>        

<?php } ?>
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