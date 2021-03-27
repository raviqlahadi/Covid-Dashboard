<main class="c-main">
    <div class="container-fluid">
        <div id="ui-view">
            <div>
                <div class="fade-in">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <?php echo $page_title ?>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 px-5">
                                            <form class="" action="" method="get">
                                                <div class="form-group row">
                                                    <?php echo $this->form_template->select('Status', 'status', $status_select, (isset($form_value) && isset($form_value['status'])) ? $form_value['status'] : null, 'Pilih Status') ?>
                                                </div>
                                                <div class="form-group row">
                                                    <?php echo $this->form_template->number('Umur Pasien', 'age', 'Masukan Umur Pasien', (isset($form_value) && isset($form_value['age'])) ? $form_value['age'] : null) ?>
                                                    <span class="text-danger text-sm"><?php echo (isset($form_error['age'])) ? $form_error['age'] : ''; ?></span>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-5">
                                                        <?php echo $this->form_template->date('Tanggal Mulai', 'date_start', 'Pilih tanggal', (isset($form_value) && isset($form_value['date_start'])) ? $form_value['date_start'] : null) ?>
                                                    </div>
                                                    <div class="col-1 pt-5">
                                                        <p>s/d</p>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php echo $this->form_template->date('Tanggal Akhir', 'date_end', 'Pilih tanggal', (isset($form_value) && isset($form_value['date_end'])) ? $form_value['date_end'] : null) ?>
                                                    </div>
                                                    <span class="text-danger text-sm"><?php echo (isset($form_error['date'])) ? $form_error['date'] : '' ?></span>

                                                </div>



                                                <div class="form-group row">
                                                    <?php echo $this->form_template->filter('patient') ?>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col-12">
                                            <div class="float-left">
                                                <a class="btn btn-primary text-white" href="<?php echo $page_url . '/create'; ?>"><i class="fa fa-plus"></i> Pasien Baru</a>
                                                <a class="btn btn-success text-white" href="<?php echo site_url('recap'); ?>"><i class="fa fa-file-excel"></i> Rekap</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="px-3"><?php if ($this->session->flashdata('alert') !== null) echo $this->session->flashdata('alert') ?></div>
                                            <?php $this->load->view($page_current . '/table') ?>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                if ($pagination != false) {
                                    echo  '<div class="card-footer">
                                                    ' . $pagination . '
                                                </div>';
                                }
                                ?>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php
if ($this->input->get('search') != null) {
?>
    <script>
        let collapseSearch = document.getElementById('collapseSearch');
        let searchInput = document.getElementById('search');

        collapseSearch.classList.add('show');
        search.value = '<?php echo $this->input->get('search') ?>';
    </script>
<?php
}
?>