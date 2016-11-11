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
                    <h2>Avez vous pris votre voiture ? </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>
                    <div class="x_content">
                        <table id="table" class="table table-bordered table-hover table-striped table-condensed">
                        	<thead>
                        		<tr class="info">
                        			<th>Référence</th>
                        			<th>Date</th>
                        			<th>Adversaire</th>
                        			<th>Division</th>
                        			<th>Localisation</th>
                                    <th>Coût du trajet</th>
                        			<th>Avez-vous pris votre voiture ?</th>                                    
                        		</tr>
                        	</thead>
                        	<tbody>
                                <?php if($matchs != null && $matchs != ''){ ?>
                            		<?php foreach ($matchs as $match) { ?>
                            		<?php 
                            			$e = new Equipe_adapter();
                            			$c = new Calendrier_adapter();
                            			$dt = new Drivertool_adapter();
                                        $d = new Division_adapter();
                            			$date = $c->sqlToDate($c->suppressMidnight($match->getDateMatch()));
                            			$equipe = $e->getAdversaireById($match->getIdAdversaire());
                            			$data = $dt->isTookHisCar($match->getIdMatch(), $this->session->userdata('idMembre'));
                                        $division = $d->getDivisionByIdDivision($match->getIdDivision());

                                        $string = $data['isTookHisCar']  ? 'Oui' : 'Non';
                                        $class = $data['isTookHisCar'] ?
                                                    "<p class='btn btn-success btn-xs'>Oui</p>" ://href='".base_url()."drivertool/save/".$match->getIdMatch()."/".$this->session->userdata('idMembre')." ''>Oui</a>" :
                                                    "<p class='btn btn-danger btn-xs'>Non</p> "//href='".base_url()."drivertool/save/".$match->getIdMatch()."/".$this->session->userdata('idMembre')." ''>Non</a>"                                                
                                                    


                            		?>
                                    
                                		<tr <?php if($string == 'Non' && $data['travelCost'] > 0){ echo "class='danger' ";} ?>  >
                                        <?php echo form_open('drivertool/save'); ?>
                                            <form>
                                				<td><?php echo $match->getReference() ?></td>
                                				<td><?php echo $date ?></td>
                                				<td><?php echo $equipe->getNomLong() ?></td>
                                				<td><?php echo $division->getNom(); ?></td>
                                				<td><?php echo $match->getIsDomicile() ? '<i class="fa fa-home"></i>' : '<i class="fa fa-car"></i>' ?></td>
                                                <td><input size="2" class="text-center" type="text" name="cout" value ="<?php echo $data['travelCost'];?>" >  €</td>
                                                <input type="hidden" name="id_match" value="<?php echo $match->getIdMatch();?>">
                                                <input type="hidden" name="id_membre" value="<?php echo $this->session->userdata('idMembre')?>">
                                				<td><input class="<?php echo $class?>" type="submit" name = "submit_driver" value="<?php echo $string?>" /></td>                                                
                                                
                                            </form>
                            			</tr>
                                      
                            		<?php } ?>
                                <?php } ?>
                        	</tbody>	
                        </table>
                    </div>
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