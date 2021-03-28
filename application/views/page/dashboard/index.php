 <main class="c-main">
     <div class="container-fluid">
         <div id="ui-view">
             <div>
                 <div class="fade-in">
                     <div class="row">
                         <div class="col-12">
                             <h3>Monitoring Covid-19</h3>
                         </div>
                     </div>
                 </div>
                 <div class="fade-in">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="card">
                                 <div class="card-header">Total Pasien Harian
                                     <div class="card-header-actions"><a class="card-header-action" href="<?php echo site_url('recap'); ?>" ><small class="text-muted">Rekap</small></a></div>
                                 </div>
                                 <div class="card-body">
                                     <div class="c-chart-wrapper">
                                         <div class="chartjs-size-monitor">
                                             <div class="chartjs-size-monitor-expand">
                                                 <div class=""></div>
                                             </div>
                                             <div class="chartjs-size-monitor-shrink">
                                                 <div class=""></div>
                                             </div>
                                         </div>
                                         <canvas id="canvas-1" style="display: block; " height="332" class="chartjs-render-monitor"></canvas>
                                     </div>
                                 </div>
                             </div>

                         </div>
                         <div class="col-lg-12">
                             <div class="row">
                                 <div class="col-6 col-lg-3">
                                     <div class="card overflow-hidden">
                                         <div class="card-body p-0 d-flex align-items-center">
                                             <div class="bg-primary p-4 mfe-3">
                                                 <i class="fa fa-users"></i>
                                             </div>
                                             <div>
                                                 <div class="text-value text-primary"><?php echo $recap[0] ?></div>
                                                 <div class="text-muted text-uppercase font-weight-bold small">Total Kasus</div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-6 col-lg-3">
                                     <div class="card overflow-hidden">
                                         <div class="card-body p-0 d-flex align-items-center">
                                             <div class="bg-warning p-4 mfe-3">
                                                 <i class="fa fa-bed"></i>
                                             </div>
                                             <div>
                                                 <div class="text-value text-warning"><?php echo $recap[1] ?></div>
                                                 <div class="text-muted text-uppercase font-weight-bold small">Dirawat</div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-6 col-lg-3">
                                     <div class="card overflow-hidden">
                                         <div class="card-body p-0 d-flex align-items-center">
                                             <div class="bg-success p-4 mfe-3">
                                                 <i class="fa fa-check-square"></i>
                                             </div>
                                             <div>
                                                 <div class="text-value text-success"><?php echo $recap[2] ?></div>
                                                 <div class="text-muted text-uppercase font-weight-bold small">Sembuh</div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-6 col-lg-3">
                                     <div class="card overflow-hidden">
                                         <div class="card-body p-0 d-flex align-items-center">
                                             <div class="bg-danger p-4 mfe-3">
                                                 <i class="fa fa-window-close"></i>
                                             </div>
                                             <div>
                                                 <div class="text-value text-danger"><?php echo $recap[3] ?></div>
                                                 <div class="text-muted text-uppercase font-weight-bold small">Meninggal</div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="card">
                                 <div class="card-header">Jumlah Pasien Positif Berdasarkan Umur
                                     <div class="card-header-actions"><a class="card-header-action" href="" target="_blank"><small class="text-muted">Rekap</small></a></div>
                                 </div>
                                 <div class="card-body">
                                     <div class="c-chart-wrapper">
                                         <div class="chartjs-size-monitor">
                                             <div class="chartjs-size-monitor-expand">
                                                 <div class=""></div>
                                             </div>
                                             <div class="chartjs-size-monitor-shrink">
                                                 <div class=""></div>
                                             </div>
                                         </div>
                                         <canvas id="canvas-3" width="465" height="232" class="chartjs-render-monitor" style="display: block; width: 465px; height: 232px;"></canvas>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-6">

                             <div class="card">
                                 <div class="card-header">Total Status Pasien
                                     <div class="card-header-actions"><a class="card-header-action" href="" target="_blank"><small class="text-muted">Rekap</small></a></div>
                                 </div>
                                 <div class="card-body">
                                     <div class="c-chart-wrapper">
                                         <div class="chartjs-size-monitor">
                                             <div class="chartjs-size-monitor-expand">
                                                 <div class=""></div>
                                             </div>
                                             <div class="chartjs-size-monitor-shrink">
                                                 <div class=""></div>
                                             </div>
                                         </div>
                                         <canvas id="canvas-5" width="465" height="232" class="chartjs-render-monitor" style="display: block; width: 465px; height: 232px;"></canvas>
                                     </div>
                                 </div>
                             </div>

                         </div>

                     </div>
                 </div>
             </div>

         </div>
 </main>