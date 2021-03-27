
<form class="" action="<?php echo $form_action ?>" method="post">
    <div class="form-group row">
        <?php echo $this->form_template->date('Tanggal', 'date', 'Pilih tanggal', (isset($form_value) && isset($form_value['date'])) ? $form_value['date'] : null) ?>
        <span class="text-danger text-sm"><?php echo form_error('date'); ?></span>
    </div>
    <div class="form-group row">
        <?php echo $this->form_template->text('Nomor Pasien', 'patient_number', 'Masukan Nomor Pasien', (isset($form_value) && isset($form_value['patient_number'])) ? $form_value['patient_number'] : null, true) ?>
        <span class="text-danger text-sm"><?php echo form_error('patient_number'); ?></span>
    </div>
    <div class="form-group row">
        <?php echo $this->form_template->number('Umur Pasien', 'age', 'Masukan Umur Pasien', (isset($form_value) && isset($form_value['age'])) ? $form_value['age'] : null) ?>
        <span class="text-danger text-sm"><?php echo form_error('age'); ?></span>
    </div>
    <div class="form-group row">
        <?php echo $this->form_template->select('Status', 'status', $status_select, (isset($form_value) && isset($form_value['status'])) ? $form_value['status'] : null, 'Pilih Status') ?>
        <span class="text-danger text-sm"><?php echo form_error('status'); ?></span>
    </div>

    <div class="form-group row">
        <?php echo $this->form_template->submit() ?>
    </div>

</form>