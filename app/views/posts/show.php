<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row ">
      <div class="col-md-4">
          <a class="btn btn-primary pull-right" href="<?php echo URLROOT ;?>/posts"><i class="fa fa-backward"></i> retour</a>
      </div>
  </div>
        <div class="card mb-3 mt-2">
            <div class="card-body"><h2 class="card-text"><?php echo  $data['post']->title ;?></h2></div>
            <p class="card-body">
                <?php echo  $data['post']->body ;?>
            </p>
            <p class="card-title bg-light p-2 mb-3">
             Créé <?php echo $data['user']->name ;?> le <?php echo  $data['post']->created_at ;?>
            </p>

            <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
                <div class="row">
                    <div class="col">
                        <a href="<?php echo URLROOT ;?>/posts/edit/<?php echo $data['post']->id ;?>" class="btn btn-secondary btn-block">Edit</a>
                    </div>
                </div>
            <?php endif ;?>
        </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>