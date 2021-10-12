<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <div class="row">
                    <div class="col">
                        <h2 class="card-text">Ajouter un animal</h2>
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/animals" class="btn btn-light pull-right"><i class="fa fa-backward"></i> Back</a>
                    </div>

                </div>
                <p class="card-text">Entrer un email et un mot de passe</p>
            </div>

            <div class="card-body">
                <form method="post" action="<?php echo URLROOT; ?>/Animals/add">
                    <div class="form-group">
                        <label for="nom">Nom<sub>*</sub></label>
                        <input type="text" name="nom" class="form-control form-control-lg <?php echo (!empty($data['nom_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nom']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nom_err']; ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="password">Description<sub>*</sub></label>
                        <textarea type="text" name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>">

                        </textarea><span class="invalid-feedback"><?php echo $data['nom_err']; ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="age">Age<sub>*</sub></label>
                        <input type="text" name="age" class="form-control form-control-lg <?php echo (!empty($data['age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['age']; ?>">
                        <span class="invalid-feedback"><?php echo $data['age_err']; ?> </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block pull-left" value="Ajouter Animal">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>