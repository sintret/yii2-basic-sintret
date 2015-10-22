<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = $settings->applicationName . ' - Dashboard';
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/xenon-components.css');
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/fonts/linecons/css/linecons.css');
$this->registerCssFile('//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
////code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css
//echo \Yii::$app->session->get('branch');
//echo 'branchId :'.Yii::$app->user->identity->branchId;
//echo 'role :'.Yii::$app->user->identity->role;
$this->registerJsFile('https://apis.google.com/js/platform.js', ['jsOptions' => ['asynch', 'defer'], 'depends' => [app\assets\AppAsset::className()]]);
?>
<p>&nbsp;</p>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?php echo app\models\Order::getCount(date('Y-m-d')); ?>
                </h3>
                <p>
                    Order
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['order/create']); ?>">
                Go to Order <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue-gradient">
            <div class="inner">
                <h3>
                    <?php echo app\models\Stock::getCount(); ?>
                </h3>
                <p>
                    Stock
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['/stock']); ?>">
                Go to Stock <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    Reports
                </h3>
                <p>
                    Graphic
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['report/index']); ?>">
                Go to Graphic <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div>
<hr>


<div class="row">
    <!-- Left col -->
    <section class="col-lg-9 connectedSortable ui-sortable">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Orders</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Delivery</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($models) foreach($models as $model){ ?>
                            <tr>
                                <td><a href="<?php echo Url::to(['order/view', 'id'=>$model->id]);?>"><?php echo $model->po;?></a></td>
                                <td><?php echo $model->member->shipping_fullname;?></td>
                                <td><?php echo $model->shipping->address;?></td>
                                <td><?php echo $model->delivery->username;?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            
        </div>

    </section><!-- /.Left col -->
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Delivered</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    
                    <?php if($recents) foreach($recents as $recent) { ?>
                    <li class="item">
                        <div class="product-img">
                            09:10
                        </div>
                        <div class="product-info">
                            <a href="javascript::;" class="product-title"><?php echo $recent->po;?> <span class="label label-warning pull-right"><?php echo app\components\Util::Rp($recent->total);?></span></a>
                            <span class="product-description">
                                <?php echo $recent->shipping->address;?>
                            </span>
                        </div>
                    </li><!-- /.item -->
                    <?php } ?>
                    
                    
                </ul>
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="javascript::;" class="uppercase">View All Recents</a>
            </div><!-- /.box-footer -->
        </div>
        
    </div><!-- /.end col-md-3 -->

</div>