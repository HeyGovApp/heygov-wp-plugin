<div class="heygov-card heygov-mb-3 heygov-border-1">
    <div class="heygov-card-body">
        <!-- <div class="heygov-row">
            <div class="heygov-col heygov-pt-3">
                <h3 class="heygov-h3">Forms &amp; Permits</h3>
            </div>
            <div class="heygov-col-auto">
                <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms" >
                    <img src="https://files.heygov.com/assets/heygov-logo.png" alt="HeyGov Logo" height="100" width="100">
                </a>
            </div>
        </div> -->

        <div class="heygov-row heygov-mb-3">
            <?php  foreach($forms as $form ) : ?> 
                <div class="heygov-row-cols-lg-5 heygov-row-cols-md-3 heygov-row-cols-2">
                   <div class="heygov-col">
                        <a href="https://app.heygov.com/<?php echo $heygov_id; ?>/forms/<?php echo $form->slug; ?>" class="heygov-card heygov-card-form heygov-ratio heygov-ratio-1x1 heygov-my-2 heygov-text-dark <?php echo $form->icon ? 'has-icon' : ''; ?> <?php echo $form->department_id ? 'has-department' : ''; ?>" style="background-color: <?php echo $form->department->color ? $form->department->color : ''; ?>">
                            <div class="heygov-card-body">
                               <?php if(!empty($form->icon)) : ?> 
                                    <img src="<?php echo esc_url(HEYGOV_URL . 'assets/icon-' .$form->icon. '.svg') ?>" alt=""class="heygov-form-icon" width="160" height="128">
                               <?php endif; ?> 
                                <h6 class="heygov-h6 heygov-card-title"> <?php echo $form->name ?></h6>
                                <h3 class="heygov-h3 heygov-form-price"><?php echo $form->price ? '$'.number_format($form->price, 2, '.', '') : '';  ?> </h3>
                            
                            </div>
                        </a>
                   </div>
                </div>
            <?php endforeach; ?>
        </div>
           
    </div>
</div>


