<?php
//var_dump($_GET);
$result = (new DBResult())->readContent($id);
//var_dump($result);
$triboje = "'#00BB20', '#BBBB20','#BB0020'";
$tmpres = array();

//osnovna prerabotka na podatoci, presmetka na poeni

foreach ($result as $r){
    $found = false;
    foreach ($tmpres as $s){
        if ($s['komText'] == $r->komText){
            $tmp = ['kzIzraz' => $r->kzIzraz, 'kzPoeni' => $r->kzPoeni];
            array_push($s['kZborovi'], $tmp );
            if ($tmp['kzPoeni'] > 0){
                $s['vkPoeni']+=(int)$tmp['kzPoeni'];
                $s['vkPoz']+=(int)$tmp['kzPoeni'];
            }
            else{
                $s['vkPoeni']+=abs((int)$tmp['kzPoeni']);
            }
            $found = true;
            //var_dump($s);
        }

    }
    if ($found == false){
        $tmpkz = ['kzIzraz' => $r->kzIzraz, 'kzPoeni' => $r->kzPoeni];
        $tmp = ['komText' => $r->komText, 'rezDateTime' => $r->rezDateTime, 'kZborovi' => [$tmpkz], 'vkPoeni' => abs($r->kzPoeni), 'vkPoz' => (int)$r->kzPoeni];
        if ($tmp['vkPoz'] < 0)
            $tmp['vkPoz'] = 0;
        array_push($tmpres, $tmp);
        //var_dump($tmp);
    }
}

//morris.js po datum

$tmpresDatum = array();
foreach ($tmpres as $d){
    $found = false;
    $proc = $d['vkPoz']/$d['vkPoeni']*100;
    if ($d['vkPoeni'] == 0)
        $proc = 50; //neutralen
    foreach ($tmpresDatum as &$e){  //ova & trebalo pizda mu materina
        if ($e['rezDateTime'] == $d['rezDateTime']) {
            if ($proc > 60){
                $e['vkPoz']++;
            }
            else if($proc < 40){
                $e['vkNeg']++;
            }
            else
                $e['vkNeu']++;
            $found = true;
            break;
        }
    }
    if ($found == false){
        $tmp = ['rezDateTime' => $d['rezDateTime'], 'vkPoz' => 0, 'vkNeu' => 0, 'vkNeg' => 0];
        if ($proc > 60){
            $tmp['vkPoz']++;
        }
        else if($proc < 40){
            $tmp['vkNeg']++;
        }
        else
            $tmp['vkNeu']++;
        array_push($tmpresDatum, $tmp);
    }

}
//dodavanje na dummy datum i rezultati, dnevni rezultati
$asd = ['rezDateTime' => '2016-05-27 01:31:15', 'vkPoz' => 5, 'vkNeu' => 10, 'vkNeg' => 3];
$asd2 = ['rezDateTime' => '2016-05-28 01:31:15', 'vkPoz' => 7, 'vkNeu' => 12, 'vkNeg' => 4];
$asd3 = ['rezDateTime' => '2016-05-29 01:31:15', 'vkPoz' => 4, 'vkNeu' => 8, 'vkNeg' => 6];
array_push($tmpresDatum, $asd); array_push($tmpresDatum, $asd2); array_push($tmpresDatum, $asd3);
$chartDate = json_encode($tmpresDatum);

//Line bar za vkupni komentari:
$asd2 = ['rezDateTime' => '2016-05-28 01:31:15', 'vkPoz' => 12, 'vkNeu' => 22, 'vkNeg' => 7];
$asd3 = ['rezDateTime' => '2016-05-29 01:31:15', 'vkPoz' => 16, 'vkNeu' => 30, 'vkNeg' => 13];

$tmparr = array($asd); array_push($tmparr, $asd2); array_push($tmparr, $asd3);
$chartLine = json_encode($tmparr);
echo "<hr />";
var_dump($chartLine);



//produzetok za donut, demek, od sve mislenjata (+dummy):
$tmpresDonutVkupno = array('vkPoz' => 0, 'vkNeu' => 0, 'vkNeg' => 0);
foreach ($tmpresDatum as $a){
    $tmpresDonutVkupno['vkPoz'] += $a['vkPoz'];
    $tmpresDonutVkupno['vkNeu'] += $a['vkNeu'];
    $tmpresDonutVkupno['vkNeg'] += $a['vkNeg'];
}
$tmparr = array(array('label'=>'Positive', 'value'=>$tmpresDonutVkupno['vkPoz']),
    array('label'=>'Neutral', 'value'=>$tmpresDonutVkupno['vkNeu']),
    array('label'=>'Negative', 'value'=>$tmpresDonutVkupno['vkNeg'])
);
$chartDonutVkupno = json_encode($tmparr);

//top lista na zboroj, na stihoj, na nisto:
//ti si nekade kaj sto nema da te dopram
//i samo praznina mi ostana od tebeeeeei
//sto da napravam so minato nesvrsenooooou
//vidi ka-petnaes :D
$toplistKZborovi = array();
foreach ($result as $a){
    $found = false;
    foreach ($toplistKZborovi as &$b){
        if ($a->kzIzraz == $b['kzIzraz']){
            $b['kzKolicina']++;
            $found = true;
            break;
        }
    }
    if ($found == false){
        $tmp = ['kzIzraz' => $a->kzIzraz, 'kzKolicina' => 1];
        array_push($toplistKZborovi, $tmp);
    }
}
echo '<hr />';
var_dump($toplistKZborovi);

//Jojo ova e USER Array Sort, po funkcija, shablonski vrakja B-A, znaci ako B > A, B ide gore A dole

uasort($toplistKZborovi, 'sortbyPoeni');
function sortbyPoeni ($a, $b)
{
    return $b['kzKolicina'] - $a['kzKolicina'];
}

var_dump($toplistKZborovi);

//var_dump($tmpresDatum);
//var_dump($tmpres);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $product->prIme?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">26</div>
                        <div>New Comments!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>New Tasks!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>3326</td>
                                    <td>10/21/2013</td>
                                    <td>3:29 PM</td>
                                    <td>$321.33</td>
                                </tr>
                                <tr>
                                    <td>3325</td>
                                    <td>10/21/2013</td>
                                    <td>3:20 PM</td>
                                    <td>$234.34</td>
                                </tr>
                                <tr>
                                    <td>3324</td>
                                    <td>10/21/2013</td>
                                    <td>3:03 PM</td>
                                    <td>$724.17</td>
                                </tr>
                                <tr>
                                    <td>3323</td>
                                    <td>10/21/2013</td>
                                    <td>3:00 PM</td>
                                    <td>$23.71</td>
                                </tr>
                                <tr>
                                    <td>3322</td>
                                    <td>10/21/2013</td>
                                    <td>2:49 PM</td>
                                    <td>$8345.23</td>
                                </tr>
                                <tr>
                                    <td>3321</td>
                                    <td>10/21/2013</td>
                                    <td>2:23 PM</td>
                                    <td>$245.12</td>
                                </tr>
                                <tr>
                                    <td>3320</td>
                                    <td>10/21/2013</td>
                                    <td>2:15 PM</td>
                                    <td>$5663.54</td>
                                </tr>
                                <tr>
                                    <td>3319</td>
                                    <td>10/21/2013</td>
                                    <td>2:13 PM</td>
                                    <td>$943.45</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.col-lg-4 (nested) -->
                    <div class="col-lg-8">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <div class="col-lg-8">
                        <div id="morris-line-chart"></div>
                    </div>
                    <!-- /.col-lg-8 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-clock-o fa-fw"></i> Responsive Timeline
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge"><i class="fa fa-check"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge info"><i class="fa fa-save"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                <hr>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Top descriptions:
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($toplistKZborovi as $zbor):?>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment fa-fw"></i> <?=$zbor['kzIzraz']; ?>
                                    <span class="pull-right text-muted small"><em><?=$zbor['kzKolicina']; ?></em>
                                    </span>
                    </a>
                    <?php endforeach; ?>
                </div>
                <!-- /.list-group -->
                <a href="#" class="btn btn-default btn-block">View All Alerts</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
            </div>
            <div class="panel-body">
                <div id="morris-donut-chart"></div>
                <a href="#" class="btn btn-default btn-block">View Details</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i>


            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="chat">
                    <?php foreach ($tmpres as $com): ?>
                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <i class="fa <?php
                                        $prnt = '';
                                        if ($com['vkPoeni'] == 0)
                                            $prnt = 'fa-circle-o';
                                        else{
                                            $proc = $com['vkPoz']/$com['vkPoeni'] * 100;

                                            if ($proc>60)
                                                $prnt = 'fa-thumbs-o-up';
                                            else if ($proc<40)
                                                $prnt = 'fa-thumbs-o-down';
                                        }
                                        echo $prnt;
                                        ?> fa-3x" aria-hidden="true"></i> <br>
                                        <?php printf("%d/%d %.02lf%%", $com['vkPoz'], $com['vkPoeni'], $com['vkPoz']/$com['vkPoeni'] * 100); ?>
                                    </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Commentary:</strong>
                                <small class="pull-right text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> <?= $com['rezDateTime'] ?>
                                </small>
                            </div>
                            <p> <?= $com['komText'] ?>
                            </p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                            </div>
                            <p>
                                Kurac palac bela voda vojvoda
                            </p>
                        </div>
                    </li>
                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                    </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Jack Sparrow</strong>
                                <small class="pull-right text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                            </p>
                        </div>
                    </li>
                    <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>
<!-- /.row -->
<script src="jquery/jquery.min.js"></script>
<script src="morrisjs/morris.min.js"></script>
<script>
    $(function() {

        Morris.Area({
            element: 'morris-area-chart',
            data: <?=$chartDate; ?>,
            xkey: 'rezDateTime',
            ykeys: ['vkPoz', 'vkNeu', 'vkNeg'],
            labels: ['Positive', 'Neutral', 'Negative'],
            pointSize: 2,
            lineColors: [<?=$triboje; ?>],
            hideHover: 'auto',
            resize: true
        });

        Morris.Donut({
            element: 'morris-donut-chart',
            data: <?=$chartDonutVkupno; ?>,
            colors: [<?=$triboje; ?>],
            resize: true
        });

        Morris.Line({
            element: 'morris-line-chart',
            data: <?=$chartLine; ?>,
            xkey: 'rezDateTime',
            ykeys: ['vkPoz', 'vkNeu', 'vkNeg'],
            labels: ['Positive', 'Neutral', 'Negative'],
            colors: [<?=$triboje; ?>],
            resize: true
        });

        Morris.Bar({
            element: 'morris-bar-chart',
            data: [{
                y: '2006',
                a: 100,
                b: 90
            }, {
                y: '2007',
                a: 75,
                b: 65
            }, {
                y: '2008',
                a: 50,
                b: 40
            }, {
                y: '2009',
                a: 75,
                b: 65
            }, {
                y: '2010',
                a: 50,
                b: 40
            }, {
                y: '2011',
                a: 75,
                b: 65
            }, {
                y: '2012',
                a: 100,
                b: 90
            }],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            hideHover: 'auto',
            resize: true
        });

    });

</script>