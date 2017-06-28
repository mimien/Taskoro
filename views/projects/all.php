<?php
if (is_null($projects)) {
    ?>
    There aren't projects yet
    <?php
} else {
    foreach ($projects as $project) {
        ?>
        <table>
            <tr>
                <th>
                    <span class="table-head"><?php echo $project->name ?></span>
                    <i class="new-task-button material-icons" id="new-task-project-<?php echo $project->id ?>-btn">
                        playlist_add
                    </i>
                </th>
            </tr>

            <?php
            TasksController::fromProject($project->id); ?>
        </table>
        <?php
    }
}
?>
