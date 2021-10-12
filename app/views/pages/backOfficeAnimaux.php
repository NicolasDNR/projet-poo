<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row ">
    <div class="col-md-4">
        <a class="btn btn-primary pull-right" href="<?php echo URLROOT; ?>/animals"><i class="fa fa-backward"></i> Retour</a>
    </div>
</div>
<?php foreach ($data['reservation'] as $reservation) : ?>
    <div class="card mb-3 mt-2">
        <div class="card-body">
            <h2 class="card-text"><?php echo  $reservation->contact; ?></h2>
        </div>
        <p class="card-body">
            <?php echo  $reservation->text; ?>
        </p>
        <p class="card-title bg-light p-2 mb-3">
            Ajouté le <?php echo  $reservation->dateAjout; ?>
        </p>
        <a href="<?php echo URLROOT; ?>/animals/show/<?php echo $reservation->id_animal; ?>" class="btn btn-secondary btn-block">Plus...</a>
    </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>