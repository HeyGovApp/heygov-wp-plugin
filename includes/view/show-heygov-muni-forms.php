<div class="heygov-card heygov-mb-3 heygov-border-1">
    <div class="heygov-card-body">
        <div class="heygov-row">
            <div class="heygov-col heygov-pt-3">
                <h3>Forms &amp; Permits</h3>
            </div>
            <div class="heygov-col-auto">
                <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms" >
                    <img src="https://files.heygov.com/assets/heygov-logo.png" alt="HeyGov Logo" height="100" width="100">
                </a>
            </div>
        </div>
        <div class="heygov-card heygov-mb-3">
            <div class="heygov-card-body heygov-p-3">
                <div class="heygov-row row-cols row-cols-2 row-cols-md-3 row-cols-lg-4 heygov-mb-3">
                    <?php  foreach($forms as $form ) : ?> 
                        <div class="col heygov-my-2 px-3">
                            <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms/<?php echo $form->slug; ?>" class="heygov-card heygov-card-form text-dark ratio ratio-1x1" style="background: <?php echo $form->department_color ? $form->department_color : 'rgba(224, 224, 224, 0.4)'; ?>"> 
                                <i class="fas fa-<?php echo $form->icon ? $form->icon : ''?> fa-8x heygov-form-icon"></i>
                                <div class="heygov-card-body heygov-p-3">
                                    <h6>
                                        <?php echo $form->name ?>
                                    </h6>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


