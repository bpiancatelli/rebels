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
                <table id="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Licence</th>
                            <th>Email</th>
                            <th>Connexion</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($membres as $key => $membre) { ?>
                        <tr>
                            <td><?php echo $membre->getNom();?></td>
                            <td><?php echo $membre->getPrenom();?></td>
                            <td><?php echo $membre->getLicence();?></td>
                            <td><?php echo $membre->getEmail();?></td>
                            <td><?php echo $membre->getDerniereConnexion();?></td>
                            <td><?php echo $membre->getIsAdministrateur() ? 
                                "<a class='btn btn-danger btn-xs' href='".base_url()."admin/deactive/".$membre->getIdMembre()."''>Désactiver</a>" : 
                                "<a class='btn btn-success btn-xs' href='".base_url()."admin/active/".$membre->getIdMembre()."''>Activer</a>"?>
                            </td>
                            
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