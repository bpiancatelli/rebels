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
        <div class="col-md-6 col-sm-6 col-xs-12">  
            <div class="x_panel tile fixed_height_350">
                <div class="x_title">
                    <h2>Ajouter au calendrier</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <?php                     
                    echo form_open('membre/add/curlcalendrier');
                ?>  
                <form>
                    <table>
                        <tbody>
                            <div class="x_content">  
                                <?php if(isset($erreur['calendrier']) && $erreur['calendrier'] !=null) { ?>
                                    <div class="alertmessage alert alert-danger">                                                                                        
                                        <?php echo $erreur['calendrier']; ?>                                                                                              
                                    </div>
                                <?php }?>
                                <?php if(isset($succes['calendrier']) && $succes['calendrier'] !=null) { ?>
                                <div class="alertmessage alert alert-success">                                                                                        
                                    <?php echo $succes['calendrier']; ?>                                                                                              
                                </div>
                                <?php }?>
                           

                                <tr>
                                        <td>
                                            <div class="w_left w_30">
                                                <span>Division</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w_center w_50 col-md-offset-2">
                                                <input type="text" name="division"></input>
                                            </div>
                                        </td>
                                        <div class="clearfix"></div>
                                    
                                </tr>                                    
                                <tr>
                                    
                                        <td>
                                            <div class="w_left w_30">
                                                <input class="btn btn-primary btn-block" type="submit" name="sync" value="Ajouter" />
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
               <div class="col-md-6 col-sm-6 col-xs-12">  
            <div class="x_panel tile fixed_height_350">
                <div class="x_title">
                    <h2>Cheat Sheet</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <table class="table table-bordered table-hover table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Division 2</td>
                                    <td>2BB</td>
                                </tr>
                                <tr>
                                    <td>Division 4</td>
                                    <td>4BB</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>                   
        </div>
    </div>

        <div class="col-md-12 col-sm-12 col-xs-12">  
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste calendrier</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>
                    <div class="clearfix"></div>
                </div>
                    <div class="x_content">  
                        <table id="table_calendrier" class="table table-bordered table-hover table-striped table-condensed">
                            <thead class="text-center">
                                <tr class="info">
                                    <th class="text-center">Division</th>
                                    <th class="text-center">Adversaire</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">A domicile</th>
                                    <th class="text-center">Modifier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $ca = new Calendrier_adapter();
                                    $ea = new Equipe_adapter();
                                    $d = new Division_adapter()

                                ?>

                                <?php if($calendrier != null){ ?>
                                    <?php foreach($calendrier as $match) {?>
                                        <?php 
                                            $equipe = $ea->getAdversaireById($match->getIdAdversaire());
                                            $division = $d->getDivisionByIdDivision($match->getIdDivision());
                                        ?>
                                            <tr>
                                                <td><?php echo $division->getNom(); ?></td>
                                                <td><?php echo $equipe->getNomLong(); ?></td>
                                                <td><?php echo $match->getDateMatch(); ?></td>
                                                <td><?php echo $match->getIsDomicile()? 'Home' : 'Away'; ?></td>
                                                <td><a href="<?php echo base_url()?>statistique/update/<?php echo $match->getIdMatch()?>"><i class="fa fa-pencil"></i></a></td>
                                            </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                            <tr>
                                                <td colspan="5">Pas de matchs cette saison</td>
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