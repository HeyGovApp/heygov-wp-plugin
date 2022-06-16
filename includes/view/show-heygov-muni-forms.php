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

        <div class="heygov-row align-items-stretch heygov-mb-3">
            <?php  foreach($forms as $form ) : ?> 
                <div class="heygov-col-lg-25 heygov-col-md-33 heygov-col-sm-50 heygov-card heygov-ratio heygov-ratio-1x1"style="background: <?php echo $form->department_color ? $form->department_color : 'rgba(224, 224, 224, 0.4)'; ?>">
                    <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms/<?php echo $form->slug; ?>" class="heygov-card-body heygov-card-form heygov-text-dark m-2">
                        <i class="fas fa-<?php echo $form->icon ? $form->icon : ''?> fa-8x heygov-form-icon"></i>
                        <div class="heygov-card-title">
                            <h6> <?php echo $form->name ?></h6>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
           
    </div>
</div>


