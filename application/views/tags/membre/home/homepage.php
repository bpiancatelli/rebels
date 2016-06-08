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

                <?php if($this->session->userdata('email') == '' || $this->session->userdata('email') == null){?>
                    <div class="alert alert-danger"role="navigation">
                        Si vous voulez être au courant des nouveautés, n'oubliez pas d'ajouter votre adresse mail dans l'onglet Membre / Modifier mes données
                    </div>
                <?php } ?>                

            </nav>
        </div>

    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">

        <!-- top tiles : CALENDRIER-->
        <?php if(isset($adversaires) && $adversaires != null && $adversaires != '') { ?>
            <div class="row tile_count">
                <?php foreach ($adversaires as $adversaire) { ?>
                <?php 
                    $e = new Equipe_adapter();
                    $c = new Calendrier_adapter();
                    $d = new Division_adapter();
                    $equipe = $e->getAdversaireById($adversaire->getIdAdversaire());
                    $date = $c->sqlToDate($adversaire->getDateMatch());
                    $division = $d->getDivisionByIdDivision($adversaire->getIdDivision());

                ?>
                <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
                    <div class="left"></div>
                    <div class="right">
                        <span class="count_top"> <?php echo $adversaire->getIsDomicile() ? '<i class="fa fa-home"></i> HOME' : '<i class="fa fa-car"></i> AWAY'?></span>
                        <div class="count"><?php echo $equipe->getNomLong() ?></div>
                        <div><?php echo $equipe->getAdresse().",". $equipe->getAdresseNumero()." ".$equipe->getCodePostal()." - ".$equipe->getVille() ?></div>
                        <span class="count_bottom"><i class="green"><?php echo $date ?></i> <?php echo $division->getNom()?></span>
                    </div>
                </div>
                <?php } ?>

            </div>
        <?php }else{ ?> 
         <div class="row tile_count">                
                <div class="animated flipInY col-md-12 col-sm-12 col-xs-12   tile_stats_count">
                    <div class="left"></div>
                    <div class="right">                        
                        <span class="count">Pas de match la semaine prochaine </span>
                    </div>
                </div>
            </div>


        <?php } ?> 
        <!-- /top tiles -->


        <br />        
        
        <!-- Annonce -->
        <div class="row"> 

            
            <?php if(isset($top3) && $top3 != null) {foreach($top3 as $what => $how){ ?>
                <?php foreach($top3[$what] as $key => $value){ ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">   
                        <div class="x_panel tile fixed_height_200">                            
                            <div class="x_title">                            
                                <h2>TOP 3 <?php echo strtoupper($what) ?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>                            
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">                        
                                <table class="table table-bordered table-hover table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <td>Nom</td>
                                            <td>Valeur</td>
                                        </tr>
                                    </thead>
                                    <tbody>                                         
                                        <?php $cpt = 0; foreach($value as $k => $v) { ?>
                                            <?php if($cpt < 3){ ?>
                                                <tr>    
                                                        <?php if(sizeof($v) > 1){/*TOOLTIP*/ ?>
                                                    <td title='<?php $i=1; foreach($v as $a => $z){
                                                                    if($i < sizeof($v)){
                                                                        echo $z->getPrenom()." ".$z->getNom().", ";
                                                                        $i++;
                                                                    }else{
                                                                        echo $z->getPrenom()." ".$z->getNom();
                                                                    }                                                            
                                                                } 
                                                                ?>'>
                                                            <?php echo sizeof($v)?> joueurs 
                                                            
                                                        <?php }else{?>
                                                    <td>
                                                            <?php foreach($v as $a => $z){?>
                                                                <?php /*PLAYER*/echo $z->getPrenom()." ".$z->getNom()?>

                                                            <?php }?>                                                        
                                                        <?php }?>                
                                                        
                                                    </td>
                                                    <td>
                                                        <?php if($k == ''){ $k = 0; }?>
                                                        <?php echo ($what == 'avg')? number_format($k,3) : $k?>
                                                    </td>
                                                </tr>
                                            <?php $cpt++;} ?>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>                
                    </div>
                <?php } ?>
            <?php }} ?>
        </div>
        <!-- end top3 -->


        <br/>

        <?php if(isset($championships)) { ?>
        <div class="row">        
            <?php foreach ($championships as $name => $teams) { ?>                
                <div class="col-md-6 col-sm-6 col-xs-6">   
                    <div class="x_panel tile">                            
                        <div class="x_title">                            
                            <h2><?php echo $name ?></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>                            
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">                        
                            
                                <table  class="table table-bordered table-hover table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Club</th>
                                            <th>Matchs</th>
                                            <th>Gagnés</th>
                                            <th>Perdus</th>
                                            <th>Nuls</th>
                                            <th>Pas joué</th>
                                            <th>Forfait</th>
                                            <th>AVG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($teams as $key => $value) { ?>
                                        <tr>          
                                            <?php foreach ($value as $k => $v) { ?>
                                                <td><?php echo $v ?></td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table> 
                            
                            
                        </div>
                    </div>                
                </div>        
            <?php } ?>
        </div>
        <?php } ?>
        

        <br/>


        <!--matchs joués-->        
        <?php if(isset($matchsPlayed) && $matchsPlayed != null) { ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="dashboard_graph">
                    <div class="row x_title">                        
                        <h2>Mes matchs <small>de la saison</small></h2>
                         <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                           
                    </ul>

                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="table" class="table table-bordered table-hover table-striped table-condensed">
                            <thead>
                                <tr>
                                    <?php foreach($stats as $key => $value) { ?>
                                        <td title="<?php echo $key?>"><?php echo $value?></td>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $ca = new Calendrier_adapter();
                                    $da = new Division_adapter();
                                    $ea = new Equipe_adapter();
                                    $m = new Membre_adapter();
                                    $ma = new Match_adapter();
                                    $mm = new Match_membre_model();                                                                
                                ?>                                
                                    <?php foreach ($matchsPlayed as $match) { ?>

                                    <?php
                                        $equipe = $ea->getAdversaireByIdMatchMembre($match->getIdMatch());
                                        $matchObject = $ma->getMatchById($match->getIdMatch());
                                        //$membre = $m->getMembreById($match->getIdMembre());

                                        $pa = $match->getPa();
                                        $ab = $match->getAb();
                                        $hits = $match->getHit();
                                        $bbrat = $mm->calculBBrat($match->getBb(),$pa);
                                        $krat = $mm->calculKrat($pa,$match->getK());
                                        $avg = $mm->calculAVG($ab,$hits);
                                        $obp = $mm->calculOBrat($ab,$hits,$match->getHbp(),$match->getBb());
                                        $slug = $mm->calculSLUGrat($ab,$match->getSimpleHit(),$match->getDoubleHit(),$match->getTripleHit(),$match->getHr());
                                        $sbrat = $mm->calculSBrat($match->getSb(),$match->getCs());
                                    ?>
                                        <tr>
                                            <td><?php echo $da->getDivisionByIdDivision($matchObject->getIdDivision())->getNom()?></td>
                                            <td><?php echo $ca->sqlToDate($matchObject->getDateMatch())?></td>
                                            <td><?php echo $equipe->getNomCourt() ?></td>
                                            <td><?php echo $match->getPa() ?></td>
                                            <td><?php echo $match->getAb() ?></td>
                                            <td><?php echo $match->getHit() ?></td>
                                            <td><?php echo $match->getRbi() ?></td>
                                            <td><?php echo $avg ?></td>
                                            <td><?php echo $match->getK() ?></td>
                                            <td><?php echo $krat ?></td>
                                            <td><?php echo $match->getBb() ?></td>
                                            <td><?php echo $bbrat ?></td>
                                            <td><?php echo $obp ?></td>
                                            <td><?php echo $slug ?></td>
                                            <td><?php echo $sbrat ?></td>                                        
                                        </tr>
                                    <?php } ?>                                
                            </tbody>                       
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php } ?>          
        <!--matchs joués--> 

        <br/>
        
        <div class="row">

            <?php if(isset($chartsAvg) && isset($chartsMatchList)){?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>AVG par match</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                        
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content">
                        
                            <canvas id="canvas000"></canvas>                        
                        
                    </div>

                </div>
            </div>      
            <?php } ?>

            <?php if(isset($chartsSumOut) && isset($chartsMatchList)){?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Type de retraits</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                        
                        <?php if($chartsSumOut['gofo'] != null && $chartsSumOut['k'] != null && $chartsSumOut['sac'] != null && $chartsSumOut['cs'] != null){?>
                            <canvas id="canvas_doughnut"></canvas>
                        <?php }else{ ?>
                            <div>pas de données disponibles</div>
                        <?php } ?>
                                                  
                    </div>
                </div>

            </div>
            <?php } ?>



        </div><!-- end row -->
        





















    </div>
    <!-- end page content-->

<?php if(isset($chartsAvg) && isset($chartsMatchList)){?>

    <?php 

        $mmm = new Match_membre_model();

        $matchs;
        $avgs;
        $i=0;

        foreach ($chartsMatchList as $value) {        
            $matchs[$i] = $value->getDateMatch();        
            $i++;
        }

        $i=0;
        foreach ($chartsAvg as $value) {
            $avgs[$i] = $mmm->calculAVG($value->getAb(),$value->getHit());
            $i++;
        }

    ?>
    <script type="text/javascript">  
            <?php $ca = new Calendrier_adapter(); ?>
            var lineChartData = {
                //labels: ["January", "February", "March", "April", "May", "June", "July"],
                labels:[<?php foreach ($matchs as $value) { echo '"'.$ca->sqlToDate($value).'",';} ?>],
                datasets: [
                    {
                        label: "AVG par match",
                        fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
                        strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                        pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [<?php foreach ($avgs as $value) { echo '"'.$value.'",';} ?>]
                }
            ]

            }

            $(document).ready(function () {
                new Chart(document.getElementById("canvas000").getContext("2d")).Line(lineChartData, {
                    responsive: true,
                    tooltipFillColor: "rgba(51, 51, 51, 0.55)"
                });
            });
    </script>
<?php } ?>

<?php if(isset($chartsSumOut) && $chartsSumOut != null && $chartsSumOut != '') { ?>
<?php 
    

    $sumGoFo = $chartsSumOut['gofo'];
    $sumK = $chartsSumOut['k'];
    $sumSac = $chartsSumOut['sac'];
    $sumCs = $chartsSumOut['cs'];

    $sumAll = $sumCs + $sumK + $sumGoFo + $sumSac;

    if($sumAll > 0){
        $sumGoFoPercent = number_format(($sumGoFo/$sumAll)*100,2);    
        $sumSacPercent = number_format(($sumSac/$sumAll)*100,2);    
        $sumKPercent = number_format(($sumK/$sumAll)*100,2);
        $sumCsPercent = number_format(($sumCs/$sumAll)*100,2);
    }
    
    
    
    
    
?>

<script>setTimeout(function() {
    $('.alertmessage').fadeOut('slow');
}, 20000); // <-- time in milliseconds
</script>     

<script>
var sharePiePolorDoughnutData = [
            {
                value: <?php echo $sumGoFo?>,
                color: "#455C73",
                highlight: "#34495E",
                label: "Ground Out / Fly Out ("+<?php echo $sumGoFoPercent ?>+"%)"
        },
            {
                value: <?php echo $sumSac?>,
                color: "#9B59B6",
                highlight: "#B370CF",
                label: "Sacrifice Fly ("+<?php echo $sumSacPercent ?>+"%)"
        },
            {
                value: <?php echo $sumK?>,
                color: "#BDC3C7",
                highlight: "#CFD4D8",
                label: "Strike Outs ("+<?php echo $sumKPercent ?>+"%)"
        },
            {
                value: <?php echo $sumCs?>,
                color: "#26B99A",
                highlight: "#36CAAB",
                label: "Caught Stealing ("+<?php echo $sumCsPercent ?>+"%)"
        },            
    ];
        $(document).ready(function () {
            window.myDoughnut = new Chart(document.getElementById("canvas_doughnut").getContext("2d")).Doughnut(sharePiePolorDoughnutData, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
        });
</script> 
<?php } ?>

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