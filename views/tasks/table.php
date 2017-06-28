<?php
if (is_null($tasks)) {
    ?>
    <tr>
        <td>There aren't tasks yet</td>
    </tr>
    <?php
} else {
    foreach ($tasks as $task) {
        if (!$task->isComplete) {
            ?>
            <tr>
                <td>
                    <span class="click-text">
                        <i id="more-info-<?php echo "$task->id"; ?>"
                           class="text-icon material-icons">more_horiz</i>
                        <?php echo $task->name; ?>
                        <span class="days-left-msg">
                             <?php echo $task->dueDate; ?>
                        </span>
                     </span>
                    <i id="ob-start-<?php echo "$task->id-$task->name-$task->currentInterval"; ?>"
                       class="task-button material-icons">play_arrow</i>
                </td>
            </tr>
        <?php }
    }
}
?>