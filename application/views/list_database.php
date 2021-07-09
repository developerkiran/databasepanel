<table class="table" id="listResults" width="100%">
    <thead>
        <tr>
            <th>Sr.no</th>
            <th><?php echo $this->lang->line('lbl_database_name') ?></th>
            <th><?php echo $this->lang->line('lbl_action') ?></th>
        </tr>
    </thead>
    <tbody>

        <?php 
        $count=1;
        foreach ($alldatabase as $db) {

            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $db; ?></td>
                <td><a href="<?php echo base_url().'ManageDatabase/listtables/'.$db;?>">show all table</a></td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<hr>
<a href="<?php echo base_url('welcome') ?>" class="btn btn-primary">back to main page</a>