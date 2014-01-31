<?php if ($lookup_type != "all") :

    $heading = array();

    $link_plural = ($total > 1) ? " links " : " link ";

    switch ($lookup_type) {
        case 'label':
            $heading['icon']    =   'barley-icon-circle';
            $heading['title']    =   $total . $link_plural . "labeled " . $active_label['label_name'];
            break;
        case 'archive':
            $heading['icon']    =   'barley-icon-briefcase';
            $heading['title']    =   $total . $link_plural . "archived";
            break;
        case 'tag':
            $heading['icon']    =   'barley-icon-tag';
            $heading['title']    =   $total . $link_plural . "tagged " . $active_tag['tag_name'];;
            break;       
    }
?>
<h2 class="marks-heading"><i class="<?php print $heading['icon']; ?>"></i> <?php print $heading['title']; ?></h2>
<?php endif; ?>
<div class="marks">
    <div class="marks_list">
        <?php foreach ($marks as $mark) :

                $notes = ($mark->notes == "" ? "<span class='action' data-action='marks_clickEdit'>Add a note...</span>" : $mark->notes);
                $preview = ($mark->embed == "" ? 0 : $mark->embed);

                $marks_data = array(
                    "mark_id"       => $mark->mark_id,
                    "label_id"      => $mark->label_id,
                    "label_name"    => $mark->label_name,
                    "notes"         => $notes,
                    "preview"       => $preview
                );

                $nice_url = rtrim(preg_replace('/https?:\/\/(www.)?/', '', $mark->url), '/');

            ?>
            <div id="mark-<?php print $mark->mark_id; ?>" class="mark label-<?php print $mark->label_id; ?>">
                <h2><?php print $mark->title; ?></h2>
                <div class="mark-meta">
                    <span class="mark-date"><?php print $mark->nice_time; ?></span>
                    <span class="mark-sep">&bull;</span>
                    <span class="mark-link"><a target="_blank" href="<?php print $mark->url; ?>"><?php print $nice_url; ?></a></span>
                </div>
                <div class="mark-actions">
                    <a class="action" href="#" data-action="show_mark_info" data-mark="mark-data-<?php print $mark->mark_id; ?>" class="mark-more">
                        <i class="barley-icon-elipsis"></i>
                    </a>
                    <?php if ($lookup_type == "archive") : ?>
                        <a class="action mark-archive" data-action="mark_restore" href="#" data-id="<?php print $mark->mark_id; ?>">
                            <i class="barley-icon-refresh"></i>
                        </a>
                    <?php else : ?>
                        <a class="action mark-archive" data-action="mark_archive" href="#" data-id="<?php print $mark->mark_id; ?>">
                            <i class="barley-icon-ok"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <script id="mark-data-<?php print $mark->mark_id; ?>" type="application/json"><?php echo json_encode($marks_data); ?></script>
            </div>
        <?php endforeach; ?>
    </div>
</div>