<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $title; ?></h3>
    </div><!-- /panel-heading -->

    <div class="panel-body">
	    <form role="form" action="<?= $path; ?>" id="<?= $id_form; ?>"method="post">
            <?= $content; ?>
        </form>
    </div> <!-- panel-body -->
</div><!-- panel panel-primary -->