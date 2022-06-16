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

        <div class="heygov-row heygov-mb-3">
            <?php  foreach($forms as $form ) : ?> 
                <div class="heygov-col-lg-25 heygov-col-md-33 heygov-col-sm-50" style="background: <?php echo $form->department_color ? $form->department_color : ''; ?>">
                   <div class="heygov-card heygov-ratio heygov-ratio-1x1 ms-2 <?php echo $form->icon ? 'has-icon' : ''; ?>">
                        <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms/<?php echo $form->slug; ?>" class="heygov-text-dark">
                            <div class="heygov-card-body heygov-card-form">
                                <i class="fa fa-<?php echo $form->icon ? $form->icon : ''?> fa-5x heygov-form-icon"></i>
                                <div class="heygov-card-title">
                                    <h6> <?php echo $form->name ?></h6>
                                </div>
                            </div>
                        </a>
                   </div>
                </div>
            <?php endforeach; ?>
        </div>
           
    </div>
</div>


