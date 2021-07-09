<table class="table" id="listResults" width="100%">
    <thead>
        <tr>
            <th>Sr.no</th>
            <th><?php echo $this->lang->line('lbl_database_name') ?></th>
        </tr>
    </thead>
    <tbody>

        <?php 
        $count=1;
        foreach ($tables as $tb) {

            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $tb; ?></td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<hr>
<a href="<?php echo base_url('ManageDatabase/ListAllDatabase') ?>" class="btn btn-primary">back to all Database</a>
<a href="<?php echo base_url('welcome') ?>" class="btn btn-primary">back to main page</a>
