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
                    <h2>Cotisation</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>            

                <table class="table table-bordered table-hover table-striped table-condensed">

                    <?php if(isset($erreur['cotisation']) && $erreur['cotisation'] !=null) { ?>                    
                        <div class="alertmessage alert alert-danger">
                            <?php echo $erreur['cotisation']?>
                        </div>
                    
                    <?php }?>

                    <?php if(isset($succes['cotisation']) && $succes['cotisation'] !=null) { ?>
                    <div class="alertmessage alert alert-success">                                                                                        
                        <?php echo $succes['cotisation']; ?>                                                                                              
                    </div>
                    <?php }?>
                	<thead>
                		<tr>
                			<?php foreach($infos as $key => $value){ ?>
                				<td><?php echo $value ?></td>	
                			<?php } ?>
                			<td>Modifier</td>
                		</tr>
                	</thead>
                	<tbody>

                        <?php 
                            $ca = new Cotisation_adapter();                            
                        ?>

                		<?php foreach($membres as $membre){ ?>                                

                        <?php                     
                            echo form_open('membre/add/cotisation/'.$membre->getIdMembre());
                        ?>

                        <?php                            
                            $cotisation = $ca->getCotisationByMembre($membre->getIdMembre());
                        ?>
                        <form>
                            <tr>                                
	                			<td><?php echo $membre->getPrenom()." ".$membre->getNom() ?></td>                                   
                                <td><input type="text" size="4" name="cotisation_paye" value="<?php echo $cotisation->getCotiPaye() ?>"/></td>
                                <td><input type="text" size="4" name="cotisation_total" value="<?php echo $cotisation->getCotiTotal() ?>"/></td>
                                <?php if($cotisation->getCotiTotal()-$cotisation->getCotiPaye() == 0 && $cotisation->getCotiTotal() != 0){ ?>
                                    <td class="alert alert-success">
                                        <?php echo $cotisation->getCotiTotal()-$cotisation->getCotiPaye()?>
                                    </td>

                                <?php }elseif($cotisation->getCotiTotal()-$cotisation->getCotiPaye() > 0 && $cotisation->getCotiTotal() != 0) {?>
                                    <td class="alert alert-danger">
                                        <?php echo $cotisation->getCotiTotal()-$cotisation->getCotiPaye()?>
                                    </td>
                                <?php }else{ ?>
                                    <td class="alert alert-info">
                                        Champs à modifier
                                    </td>
                                <?php } ?>


                                <td><input class="btn btn-success btn-xs" type="submit" name="submit" value="Updater" /></td>                    
                            </tr>
                        </form>

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