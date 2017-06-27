<table>
    <tr>
        <th>
            <span class="table-head">Tasks</span>
            <i class="new-task-button material-icons" id="create-obligation-btn">playlist_add</i>
        </th>
    </tr>

    <?php
    if (is_null($obligations)) {
        ?>
        <tr>
            <td>There aren't tasks yet</td>
        </tr>
        <?php
    } else {
        foreach ($obligations as $obligation) {
            ?>
            <tr>
                <td>
                    <span class="click-text">
                        <i id="more-info-<?php echo "$obligation->id"; ?>" class="text-icon material-icons">more_horiz</i>
                        <?php echo $obligation->name; ?>
                        <span class="days-left-msg">
                             <?php echo $obligation->dueDate; ?>
                        </span>
                     </span>
                    <i id="ob-start-<?php echo "$obligation->id-$obligation->name-$obligation->currentInterval"; ?>"
                       class="task-button material-icons">play_arrow</i>
                </td>
            </tr>
        <?php }
    }
    ?>
</table>