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
        <div class="col-md-4 col-sm-4 col-xs-12">  
            <div class="x_panel tile fixed_height_350">
                <div class="x_title">
                    <h2>Ajouter un membre</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <?php                     
                    echo form_open('membre/add/membre');
                ?>  
                <form>
                    <table>
                        <tbody>
                            <div class="x_content">  
                                <?php if(isset($erreur['membre']) && $erreur['membre'] !=null) { ?>
                                    <div class="alertmessage alert alert-danger">                                                                                        
                                        <?php echo $erreur['membre']; ?>                                                                                              
                                    </div>
                                <?php }?>
                                <?php if(isset($succes['membre']) && $succes['membre'] !=null) { ?>
                                <div class="alertmessage alert alert-success">                                                                                        
                                    <?php echo $succes['membre']; ?>                                                                                              
                                </div>
                                <?php }?>
                                <tr>
                                    
                                        <td>
                                            <div class="w_left w_30">
                                                <span>Nom</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w_center w_50 col-md-offset-2" >
                                                <input type="text" name="nom"></input>
                                            </div>
                                        </td>
                                        <div class="clearfix"></div>
                                    
                                </tr>

                                <tr>
                                    
                                        <td>
                                            <div class="w_left w_30">
                                                <span>Prenom</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w_center w_50 col-md-offset-2">
                                                <input type="text" name="prenom"></input>
                                            </div>
                                        </td>
                                        <div class="clearfix"></div>
                                    </div>
                                </tr>

                                <tr>

                                        <td>
                                            <div class="w_left w_30">
                                                <span>Email</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w_center w_50 col-md-offset-2">
                                                <input type="text" name="email"></input>
                                            </div>
                                        </td>
                                        <div class="clearfix"></div>
                                    
                                </tr>                                

                                <tr>
                                    
                                        <td>
                                            <div class="w_left w_30">
                                                <input class="btn btn-primary btn-block" type="submit" name="submit_membre" value="Ajouter" />
                                            </div>
                                        </td>
                                        <div class="clearfix"></div>
                                    

                                </tr>                                         
                            </div>
                        </tbody>
                    </table>
                </form>
            </div>            
        </div>
         <div class="col-md-8 col-sm-8 col-xs-12">  
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste membre</h2>
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
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prenom</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Derniere Connexion</th>
                                    <th class="text-center">Statut</th>
                                </tr>
                            </thead>
                            <?php 
                                $ca = new Calendrier_adapter();
                                
                            ?>
                            <?php foreach($membres as $membre) {?>   

                                    <tr>
                                        <td><?php echo $membre->getNom()?></td>
                                        <td><?php echo $membre->getPrenom(); ?></td>
                                        <td><?php echo $membre->getEmail(); ?></td>
                                        <td><?php echo $ca->sqlToDate($ca->suppressMidnight($membre->getDerniereConnexion())); ?></td>
                                        <td>                                            
                                            <?php 
                                                
                                                echo $membre->getIsActif()? 
                                                "<a class='btn btn-danger btn-xs' href='".base_url()."membre/deactive/".$membre->getIdMembre()."''>Désactiver</a>" :
                                                "<a class='btn btn-success btn-xs' href='".base_url()."membre/active/".$membre->getIdMembre()."''>Activer</a>"
                                            ?>                                            
                                        </td>
                                    </tr>
                            <?php } ?>
                        </table>
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