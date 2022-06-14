<div class="heygov-row">
    <div class="col pt-3">
        <h3>Forms &amp; Permits</h3>
    </div>
    <div class="col-auto">
        <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms" >
            <img src="https://files.heygov.com/assets/heygov-logo.png" alt="HeyGov Logo" height="100" width="100">
        </a>
    </div>
   
</div>

<div class="heygov-card heygov-mb-3">
    <div class="heygov-card-body heygov-p-3">
        <div class="heygov-row row-cols row-cols-2 row-cols-md-3 heygov-row-cols-lg-4 heygov-mb-3" style="overflow: hidden; ">
            <?php  foreach($forms as $form ) : ?> 
                <div class="col heygov-my-2 px-3">
                    <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms/<?php echo $form->slug; ?>" class="heygov-card heygov-card-form heygov-text-dark ratio ratio-1x1 <?php echo $form->icon ? 'has-icon' : ''?>"> 
                        <i class="fas fa-<?php echo $form->icon ? $form->icon : ''?> fa-8x" style="right: -1.6rem!important; position: absolute; left: auto;width: 8rem;height: 8rem;color: #e0e0e0;opacity: 0.5;overflow: hidden;"></i>
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

