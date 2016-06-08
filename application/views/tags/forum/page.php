<?php 

    $gentelella = base_url()."../plugins/gentelella/production/";
    $datatables = base_url()."../plugins/datatables/";    
    
    $where = $this->uri->uri_string();
    $what;
    $id = '';
    $new = "nouveau";

    switch ($where) {
        case strpos($where,'thematique') !== false:
            $new = "nouvelle";
            $what = "thematique";
            $id = $this->uri->segment(4);         
            break;
        case strpos($where,'sujet') !== false:        
            $what = "sujet";
            $id = $this->uri->segment(4);
            break;
        case strpos($where,'message') !== false:
            $what = "message";
            $id = $this->uri->segment(4);
            break;

        case strpos($where,'index') !== false:
        default:
            $what = "dossier";
            break;
    }
    

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
                    <div class="col-md-6 col-sm-6 col-xs-6" >
                        <h2>Menu <?php echo $titre ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"></i></a></li>                           
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right" >
                        <a href="<?php echo base_url()?>forum/add/<?php echo $what.'/'.$id?>" class="label label-primary"><?php echo ucfirst($new)." ".ucfirst($what)?></a>
                        <a href="<?php echo base_url()?>forum/show/dossier" class="label label-primary">Retour</a>
                    </div>
                    <div class="clearfix"></div>
                    
                    <table id="table" class="table table-bordered table-hover table-striped table-condensed">
                       <?php if ($content != null ){ ?>
                            <?php foreach ($content as $key => $value) { ?>
                                <?php if ($value instanceof Forum_dossier_model) {?>
                                    <tr>
                                        <td><a href="<?php base_url()?>thematique/<?php echo $value->getIdForumDossier()?>"><?php echo $value->getNomDossier()?></a></td>
                                    </tr>
                                <?php }elseif ($value instanceof Forum_thematique_model) { ?>
                                    <tr>
                                        <td><a href="<?php base_url()?>../sujet/<?php echo $value->getIdForumThematique()?>"><?php echo $value->getNomThematique()?></a></td>
                                        <td>
                                            <?php echo ($value->getSujet() > 1)? $value->getSujet()." sujets" : $value->getSujet()." sujet"?>
                                            <br>
                                            <?php echo ($value->getReponse() > 1)? $value->getReponse()." reponses" : $value->getReponse()." reponse"?>
                                        </td>
                                    </tr>
                                <?php }elseif ($value instanceof Forum_sujet_model) { ?>

                                    <?php 
                                        $m = new Membre_adapter();
                                        $createur = $m->getMembreById($value->getIdMembre());
                                    ?>
                                    <tr>
                                        <td><?php echo $value->getNomSujet() ?></td>
                                        <td>
                                                <?php echo $createur->getNom()." ".$createur->getPrenom()?>
                                                <br>
                                                <?php echo $value->getDateCreation()?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </table>            
                </div><!-- end x_title-->
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